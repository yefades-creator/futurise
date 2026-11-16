<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Benefit;
use App\Models\BenefitFulfillment;
use App\Models\Event;
use App\Models\Organization;
use App\Models\SponsorshipAgreement;
use App\Models\SponsorshipPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminSponsorshipController extends Controller
{
    private function activeEvent(): Event
    {
        return Event::where('is_active', true)->first() ?? Event::firstOrFail();
    }

    public function index()
    {
        $event = $this->activeEvent();
        $organizations = Organization::where('event_id', $event->id)
            ->where('status', 'verified')
            ->whereIn('type', ['sponsor', 'industry'])
            ->orderBy('name')
            ->get();
        $packages = SponsorshipPackage::where('event_id', $event->id)->with('benefits')->orderBy('price')->get();
        $agreements = SponsorshipAgreement::where('event_id', $event->id)
            ->with(['organization', 'package.benefits', 'fulfillments.benefit', 'fulfillments.verifier'])
            ->latest('id')
            ->get();

        return view('admin.sponsorship', compact('event', 'organizations', 'packages', 'agreements'));
    }

    public function storeAgreement(Request $request)
    {
        $event = $this->activeEvent();
        $data = $this->validateAgreement($request);
        if (!$this->validContractReference($data['contract_document'] ?? null)) {
            return back()->withInput()->withErrors(['contract_document' => 'Dokumen harus memakai tautan HTTP(S) atau path publik /docs/.']);
        }
        $organization = Organization::where('event_id', $event->id)
            ->where('status', 'verified')
            ->whereIn('type', ['sponsor', 'industry'])
            ->findOrFail($data['organization_id']);
        $this->validatePackage($data['package_id'] ?? null, $event);

        $existingAgreement = SponsorshipAgreement::where('event_id', $event->id)
            ->where('organization_id', $organization->id)
            ->whereIn('status', ['draft', 'offered', 'agreed', 'signed'])
            ->exists();
        if ($existingAgreement) {
            return back()->withInput()->withErrors(['organization_id' => 'Organisasi ini sudah memiliki kesepakatan aktif. Ubah kesepakatan yang ada.']);
        }

        $agreement = SponsorshipAgreement::create([
            ...$data,
            'event_id' => $event->id,
            'organization_id' => $organization->id,
            'agreement_number' => ($data['agreement_number'] ?? null) ?: 'SPON/' . $event->edition . '/' . strtoupper(bin2hex(random_bytes(4))),
        ]);
        AuditLog::log('sponsorship_agreement_created', 'SponsorshipAgreement', $agreement->id, null, [
            'organization_id' => $organization->id,
            'agreement_number' => $agreement->agreement_number,
            'agreed_amount' => $agreement->agreed_amount,
            'support_type' => $agreement->support_type,
            'status' => $agreement->status,
        ], "Kesepakatan sponsorship {$agreement->agreement_number} dibuat", $event->id);

        return back()->with('success', 'Kesepakatan sponsorship berhasil ditambahkan.');
    }

    public function updateAgreement(Request $request, $agreementId)
    {
        $event = $this->activeEvent();
        $agreement = SponsorshipAgreement::where('event_id', $event->id)->findOrFail($agreementId);
        $data = $this->validateAgreement($request, $agreement);
        if (!$this->validContractReference($data['contract_document'] ?? null)) {
            return back()->withInput()->withErrors(['contract_document' => 'Dokumen harus memakai tautan HTTP(S) atau path publik /docs/.']);
        }
        unset($data['organization_id']);
        $this->validatePackage($data['package_id'] ?? null, $event);

        if ($agreement->fulfillments()->exists() && (int) $agreement->package_id !== (int) ($data['package_id'] ?? 0)) {
            return back()->withInput()->withErrors(['package_id' => 'Paket tidak dapat diganti setelah manfaat mulai dicatat.']);
        }

        $old = $agreement->only(['agreement_number', 'package_id', 'agreed_amount', 'support_type', 'in_kind_description', 'status', 'agreed_at', 'contract_document']);
        $agreement->update($data);
        AuditLog::log('sponsorship_agreement_updated', 'SponsorshipAgreement', $agreement->id, $old, $agreement->only(array_keys($old)), "Kesepakatan {$agreement->agreement_number} diperbarui", $event->id);

        return back()->with('success', 'Rincian kesepakatan sponsorship berhasil diperbarui.');
    }

    public function storeFulfillment(Request $request, $agreementId)
    {
        $event = $this->activeEvent();
        $agreement = SponsorshipAgreement::where('event_id', $event->id)->with('package')->findOrFail($agreementId);
        $data = $this->validateFulfillment($request);
        $benefit = Benefit::where('package_id', $agreement->package_id)->findOrFail($data['benefit_id']);

        if ($data['status'] === 'fulfilled' && $benefit->required_proof_type !== 'none' && !$request->hasFile('proof_file') && empty($data['proof_url'])) {
            return back()->withInput()->withErrors(['proof_file' => 'Unggah file atau tautan bukti sebelum menandai manfaat terpenuhi.']);
        }

        $proofPath = $request->file('proof_file')?->store('sponsorship-proofs', 'local');
        $fulfillment = BenefitFulfillment::create([
            'agreement_id' => $agreement->id,
            'benefit_id' => $benefit->id,
            'status' => $data['status'],
            'notes' => $data['notes'] ?? null,
            'proof_url' => $data['proof_url'] ?? null,
            'proof_file' => $proofPath,
            'verified_by' => $data['status'] === 'fulfilled' ? auth()->id() : null,
            'verified_at' => $data['status'] === 'fulfilled' ? now() : null,
        ]);
        AuditLog::log('benefit_fulfillment_created', 'BenefitFulfillment', $fulfillment->id, null, [
            'agreement_id' => $agreement->id,
            'benefit_id' => $benefit->id,
            'status' => $fulfillment->status,
            'proof_file' => (bool) $proofPath,
            'proof_url' => $fulfillment->proof_url,
        ], "Pemenuhan manfaat {$benefit->name} dicatat", $event->id);

        return back()->with('success', 'Pemenuhan manfaat dan bukti berhasil dicatat.');
    }

    public function updateFulfillment(Request $request, $fulfillmentId)
    {
        $event = $this->activeEvent();
        $fulfillment = BenefitFulfillment::whereHas('agreement', fn ($query) => $query->where('event_id', $event->id))
            ->with('agreement')
            ->findOrFail($fulfillmentId);
        $data = $this->validateFulfillment($request);
        $benefit = Benefit::where('package_id', $fulfillment->agreement->package_id)->findOrFail($data['benefit_id']);

        if ($data['status'] === 'fulfilled' && $benefit->required_proof_type !== 'none' && !$request->hasFile('proof_file') && empty($data['proof_url']) && !$fulfillment->proof_file && !$fulfillment->proof_url) {
            return back()->withInput()->withErrors(['proof_file' => 'Unggah file atau tautan bukti sebelum menandai manfaat terpenuhi.']);
        }

        $old = $fulfillment->only(['benefit_id', 'status', 'proof_file', 'proof_url', 'notes']);
        $oldProofPath = $fulfillment->proof_file;
        $newProofPath = null;
        if ($request->hasFile('proof_file')) {
            $newProofPath = $request->file('proof_file')->store('sponsorship-proofs', 'local');
            $fulfillment->proof_file = $newProofPath;
        }
        $fulfillment->benefit_id = $benefit->id;
        $fulfillment->status = $data['status'];
        $fulfillment->proof_url = $data['proof_url'] ?? null;
        $fulfillment->notes = $data['notes'] ?? null;
        $fulfillment->verified_by = $data['status'] === 'fulfilled' ? auth()->id() : null;
        $fulfillment->verified_at = $data['status'] === 'fulfilled' ? now() : null;
        $fulfillment->save();
        if ($newProofPath && $oldProofPath) Storage::disk('local')->delete($oldProofPath);
        AuditLog::log('benefit_fulfillment_updated', 'BenefitFulfillment', $fulfillment->id, $old, $fulfillment->only(['benefit_id', 'status', 'proof_file', 'proof_url', 'notes']), 'Status/bukti pemenuhan sponsorship diperbarui', $event->id);

        return back()->with('success', 'Status pemenuhan dan bukti pelaksanaan berhasil diperbarui.');
    }

    public function downloadProof($fulfillmentId)
    {
        $fulfillment = BenefitFulfillment::whereHas('agreement', fn ($query) => $query->where('event_id', $this->activeEvent()->id))
            ->with('agreement')
            ->findOrFail($fulfillmentId);
        abort_unless($fulfillment->proof_file && Storage::disk('local')->exists($fulfillment->proof_file), 404);

        return Storage::disk('local')->download($fulfillment->proof_file);
    }

    private function validateAgreement(Request $request, ?SponsorshipAgreement $agreement = null): array
    {
        $agreementNumberRule = Rule::unique('sponsorship_agreements', 'agreement_number');
        if ($agreement) $agreementNumberRule->ignore($agreement->id);

        return $request->validate([
            'organization_id' => [$agreement ? 'sometimes' : 'required', 'integer', 'exists:organizations,id'],
            'package_id' => 'nullable|integer|exists:sponsorship_packages,id',
            'agreement_number' => ['nullable', 'string', 'max:100', $agreementNumberRule],
            'agreed_amount' => 'required|numeric|min:0',
            'support_type' => 'required|in:cash,in_kind,hybrid',
            'in_kind_description' => 'nullable|string|max:4000',
            'status' => 'required|in:draft,offered,agreed,signed,cancelled',
            'agreed_at' => 'nullable|date',
            'contract_document' => 'nullable|string|max:2048',
        ]);
    }

    private function validatePackage(?int $packageId, Event $event): void
    {
        if ($packageId) SponsorshipPackage::where('event_id', $event->id)->findOrFail($packageId);
    }

    private function validContractReference(?string $reference): bool
    {
        return !filled($reference) || Str::startsWith($reference, ['https://', 'http://', '/docs/']);
    }

    private function validateFulfillment(Request $request): array
    {
        return $request->validate([
            'benefit_id' => 'required|integer|exists:benefits,id',
            'status' => 'required|in:pending,in_progress,fulfilled',
            'proof_url' => 'nullable|url|max:2048',
            'proof_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'notes' => 'nullable|string|max:4000',
        ]);
    }
}
