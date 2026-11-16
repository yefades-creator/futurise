<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Team;
use App\Models\ProjectVersion;
use App\Models\TechnicalRequirement;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\TourSlot;
use App\Models\SchoolVisit;
use App\Models\Meeting;
use App\Models\FollowUp;
use App\Models\SupportTicket;
use App\Models\BenefitFulfillment;
use App\Models\Notification;
use App\Models\Booth;
use App\Services\FinanceService;
use App\Services\MeetingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class PortalController extends Controller
{
    protected function getActiveEvent()
    {
        return Event::with('venue')->where('is_active', true)->first() ?? Event::with('venue')->firstOrFail();
    }

    public function dashboard()
    {
        $user = auth()->user();
        $event = $this->getActiveEvent();
        $roleSlug = $user->activeRole?->slug ?? $user->roles->first()?->slug;

        // Get user's primary organization if any
        $organization = $user->organizations()->where('organizations.event_id', $event->id)->first();
        if (!$organization && $roleSlug === 'tim-mahasiswa') {
            $organization = Team::whereHas('members', fn ($query) => $query->where('user_id', $user->id))
                ->whereHas('organization', fn ($query) => $query->where('event_id', $event->id))
                ->with('organization')
                ->first()?->organization;
        }

        // 1. Campus / Team Portal
        if (in_array($roleSlug, ['pic-kampus', 'tim-mahasiswa'])) {
            $projectQuery = $organization ? Project::where('organization_id', $organization->id) : Project::whereRaw('1 = 0');
            if ($roleSlug === 'tim-mahasiswa') {
                $projectQuery->whereHas('team.members', fn ($query) => $query->where('user_id', $user->id));
            }
            $projects = $projectQuery->with(['team.members', 'booth', 'technicalRequirement'])->get();
            $projectCount = $organization?->projects()->where('event_id', $event->id)->count() ?? 0;
            $availableTeamsQuery = $organization?->teams() ?? Team::whereRaw('1 = 0');
            if ($roleSlug === 'tim-mahasiswa') {
                $availableTeamsQuery->whereHas('members', fn ($query) => $query->where('user_id', $user->id));
            }
            $availableTeams = $availableTeamsQuery->orderBy('name')->get();
            $invoices = $organization ? Invoice::where('organization_id', $organization->id)->with('payments')->get() : collect();
            $allocatedBooth = $organization?->allocatedBooth;
            $meetings = $organization ? Meeting::where('requester_org_id', $organization->id)->orWhere('target_org_id', $organization->id)->with(['requester', 'target', 'project'])->get() : collect();
            $followUps = $organization ? FollowUp::where('organization_id', $organization->id)->get() : collect();

            return view('portal.campus', compact('user', 'event', 'organization', 'projects', 'projectCount', 'availableTeams', 'roleSlug', 'invoices', 'allocatedBooth', 'meetings', 'followUps'));
        }

        // 2. Industry / Partner Portal
        if (in_array($roleSlug, ['pic-industri', 'pic-partner'])) {
            $allocatedBooth = $organization?->allocatedBooth;
            $meetings = $organization ? Meeting::where('requester_org_id', $organization->id)->orWhere('target_org_id', $organization->id)->with(['requester', 'target', 'project'])->get() : collect();
            $followUps = $organization ? FollowUp::where('organization_id', $organization->id)->get() : collect();
            $invoices = $organization ? Invoice::where('organization_id', $organization->id)->with('payments')->get() : collect();
            $campuses = Organization::where('type', 'campus')->where('status', 'verified')->get();

            return view('portal.industry', compact('user', 'event', 'organization', 'allocatedBooth', 'meetings', 'followUps', 'invoices', 'campuses'));
        }

        // 3. Sponsor Portal
        if ($roleSlug === 'pic-sponsor') {
            $agreement = $organization?->sponsorshipAgreement()->with(['package.benefits', 'fulfillments.benefit', 'fulfillments.verifier', 'inKindContributions'])->first();
            $invoices = $organization ? Invoice::where('organization_id', $organization->id)->with('payments')->get() : collect();

            return view('portal.sponsor', compact('user', 'event', 'organization', 'agreement', 'invoices'));
        }

        // 4. School Portal
        if ($roleSlug === 'pic-sekolah') {
            $schoolProfile = $organization?->schoolProfile;
            $visits = $organization ? SchoolVisit::where('organization_id', $organization->id)->with('tourSlot')->get() : collect();
            $availableSlots = TourSlot::where('event_id', $event->id)
                ->where('status', 'open')
                ->whereColumn('booked_count', '<', 'max_capacity')
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();

            return view('portal.school', compact('user', 'event', 'organization', 'schoolProfile', 'visits', 'availableSlots'));
        }

        // 5. Visitor Portal (Default)
        $ticket = Ticket::where('event_id', $event->id)->where('user_id', $user->id)->first();
        $votedProject = \App\Models\Vote::where('event_id', $event->id)->where('user_id', $user->id)->with('project')->first();
        $feedbacks = \App\Models\ProjectFeedback::where('user_id', $user->id)->with('project')->get();
        $surveyResponse = \App\Models\SurveyResponse::where('event_id', $event->id)->where('user_id', $user->id)->latest()->first();

        return view('portal.visitor', compact('user', 'event', 'ticket', 'votedProject', 'feedbacks', 'surveyResponse'));
    }

    /**
     * Register a new project for the user's verified campus.
     */
    public function storeProject(Request $request)
    {
        $user = auth()->user();
        $event = $this->getActiveEvent();
        $roleSlug = $user->activeRole?->slug ?? $user->roles->first()?->slug;
        abort_unless($roleSlug === 'pic-kampus', 403, 'Pendaftaran karya hanya dapat dilakukan oleh PIC Kampus.');
        $organization = $user->organizations()
            ->where('organizations.event_id', $event->id)
            ->first();
        if (!$organization) {
            return redirect()->route('portal.dashboard')->with('error', 'Akun Anda belum terhubung ke organisasi kampus pada acara ini. Minta Super Admin mengaitkan akun ke organisasi terlebih dahulu.');
        }
        if ($organization->status !== 'verified') {
            return redirect()->route('portal.dashboard')->with('error', 'Organisasi kampus harus terverifikasi sebelum karya dapat didaftarkan.');
        }
        $teamIds = $organization->teams()->pluck('teams.id');

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'team_id' => ['nullable', 'integer', \Illuminate\Validation\Rule::in($teamIds->all())],
            'title' => 'required|string|max:255',
            'category' => 'required|in:AI/IoT,Smart City,FinTech,EdTech,HealthTech,Creative Media',
            'problem_statement' => 'required|string|max:10000',
            'target_users' => 'required|string|max:5000',
            'solution_description' => 'required|string|max:10000',
            'key_features' => 'nullable|string|max:10000',
            'technology_stack' => 'nullable|string|max:255',
            'readiness_level' => 'required|string|max:100',
            'demo_url' => 'nullable|url|max:2048',
            'video_url' => 'nullable|url|max:2048',
            'collaboration_needs' => 'nullable|string|max:5000',
            'is_published_consent' => 'nullable|boolean',
        ]);
        if ($validator->fails()) {
            return redirect()->route('portal.dashboard')->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();

        try {
            DB::transaction(function () use ($event, $organization, $validated, $request) {
                Organization::whereKey($organization->id)->lockForUpdate()->firstOrFail();
                if (Project::where('event_id', $event->id)->where('organization_id', $organization->id)->count() >= 2) {
                    throw new \RuntimeException('Satu kampus dapat mendaftarkan maksimal dua karya (BR-03).');
                }

                $slugBase = \Illuminate\Support\Str::slug($validated['title']) ?: 'karya';
                $slug = $slugBase;
                while (Project::where('event_id', $event->id)->where('slug', $slug)->exists()) {
                    $slug = $slugBase . '-' . strtolower(\Illuminate\Support\Str::random(5));
                }

                Project::create([
                    ...$validated,
                    'event_id' => $event->id,
                    'organization_id' => $organization->id,
                    'team_id' => $validated['team_id'] ?? null,
                    'slug' => $slug,
                    'is_published_consent' => $request->boolean('is_published_consent'),
                    'status' => 'draft',
                    'is_locked' => false,
                ]);
            });
        } catch (\RuntimeException $exception) {
            return redirect()->route('portal.dashboard')->withInput()->with('error', $exception->getMessage());
        }

        return redirect()->route('portal.dashboard')->with('success', 'Karya berhasil didaftarkan sebagai draft. Lengkapi materinya lalu pilih Ajukan Kurasi.');
    }

    /**
     * Update project by Campus PIC / Student Team
     * Enforces BR-09: Materi terkunci saat pemeriksaan; revisi dibuka dengan catatan dan riwayat
     * Enforces Acceptance 01: Cannot modify project belonging to another organization
     */
    public function updateProject(Request $request, $projectId)
    {
        $user = auth()->user();
        $event = $this->getActiveEvent();
        $project = Project::where('event_id', $event->id)->with('organization')->findOrFail($projectId);

        // Acceptance 01: Check organization ownership
        $isAssignedStudent = $user->activeRole?->slug === 'tim-mahasiswa'
            && $project->team_id
            && $project->team()->whereHas('members', fn ($query) => $query->where('user_id', $user->id))->exists();
        $isOrganizationPic = $user->activeRole?->slug === 'pic-kampus'
            && $user->organizations->contains('id', $project->organization_id);
        if (!$isAssignedStudent && !$isOrganizationPic && !$user->isSuperAdmin()) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang atas karya institusi lain.');
        }

        // BR-09: Cannot edit if locked during review
        if ($project->is_locked) {
            return back()->with('error', 'Materi karya sedang dikunci oleh kurator untuk pemeriksaan (BR-09). Anda tidak dapat mengubah data hingga kurator membuka revisi.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'problem_statement' => 'required|string',
            'target_users' => 'required|string',
            'solution_description' => 'required|string',
            'key_features' => 'nullable|string',
            'technology_stack' => 'nullable|string',
            'readiness_level' => 'required|string',
            'test_results' => 'nullable|string',
            'limitations' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'video_url' => 'nullable|url',
            'collaboration_needs' => 'nullable|string',
            'is_published_consent' => 'nullable|boolean',
        ]);

        $validated['is_published_consent'] = $request->boolean('is_published_consent', false);

        // Create version snapshot before updating
        ProjectVersion::create([
            'project_id' => $project->id,
            'version_number' => $project->versions()->count() + 1,
            'snapshot_data' => $project->toArray(),
            'revision_notes' => 'Pembaruan materi oleh PIC/Tim',
            'submitted_by' => $user->id,
        ]);

        $project->update($validated);

        // Technical requirement
        if ($request->has('power_watt')) {
            TechnicalRequirement::updateOrCreate(
                ['project_id' => $project->id, 'organization_id' => $project->organization_id],
                [
                    'power_watt' => $request->input('power_watt', 300),
                    'internet_type' => $request->input('internet_type', 'wifi_standard'),
                    'device_list' => $request->input('device_list'),
                    'special_requests' => $request->input('special_requests'),
                    'status' => 'submitted',
                ]
            );
        }

        return back()->with('success', 'Perubahan materi karya berhasil disimpan dan dicatat dalam riwayat versi.');
    }

    /**
     * Submit project for curator review
     */
    public function submitProjectForReview($projectId)
    {
        $user = auth()->user();
        $project = Project::where('event_id', $this->getActiveEvent()->id)->findOrFail($projectId);

        $isAssignedStudent = $user->activeRole?->slug === 'tim-mahasiswa'
            && $project->team_id
            && $project->team()->whereHas('members', fn ($query) => $query->where('user_id', $user->id))->exists();
        $isOrganizationPic = $user->activeRole?->slug === 'pic-kampus'
            && $user->organizations->contains('id', $project->organization_id);
        if (!$isAssignedStudent && !$isOrganizationPic && !$user->isSuperAdmin()) {
            abort(403);
        }

        $project->update([
            'status' => 'diajukan',
            'is_locked' => true, // BR-09: lock during review
        ]);

        return back()->with('success', 'Karya berhasil diajukan untuk pemeriksaan kurator APTIKOM Jabar (Materi terkunci sementara sesuai BR-09).');
    }

    /**
     * Upload payment proof (BR-06)
     */
    public function uploadPaymentProof(Request $request, $invoiceId, FinanceService $financeService)
    {
        $invoice = Invoice::whereKey($invoiceId)->firstOrFail();
        abort_unless(auth()->user()->organizations()->whereKey($invoice->organization_id)->exists(), 403);
        abort_unless((int) $invoice->event_id === (int) $this->getActiveEvent()->id, 404);
        abort_if($invoice->status === 'cancelled', 409, 'Tagihan ini sudah dibatalkan.');
        abort_if($invoice->availableBalance() <= 0, 409, 'Tidak ada sisa tagihan yang dapat dibayarkan.');

        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . $invoice->availableBalance(),
            'payment_date' => 'required|date',
            'bank_source' => 'required|string',
            'account_holder' => 'required|string',
            'receipt_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $proofPath = null;
        try {
            $data = $request->only(['amount', 'payment_date', 'bank_source', 'account_holder']);
            $proofPath = $request->file('receipt_file')->store('payment-proofs', 'local');
            $data['receipt_file'] = $proofPath;
            $financeService->submitPaymentProof($invoice->id, $data);
            return back()->with('success', 'Bukti transfer berhasil diunggah! Status pembayaran menunggu verifikasi dari bagian Keuangan (BR-06).');
        } catch (Exception $e) {
            if ($proofPath) Storage::disk('local')->delete($proofPath);
            return back()->with('error', $e->getMessage());
        }
    }

    public function downloadSponsorshipProof($fulfillmentId)
    {
        $event = $this->getActiveEvent();
        $fulfillment = BenefitFulfillment::whereHas('agreement', fn ($query) => $query->where('event_id', $event->id))
            ->with('agreement')
            ->findOrFail($fulfillmentId);
        $isOrganizationMember = auth()->user()->organizations()
            ->whereKey($fulfillment->agreement->organization_id)
            ->exists();
        abort_unless($isOrganizationMember || auth()->user()->hasRole(['super-admin', 'industri-sponsor', 'publikasi']), 403);
        abort_unless($fulfillment->proof_file && Storage::disk('local')->exists($fulfillment->proof_file), 404);

        return Storage::disk('local')->download($fulfillment->proof_file);
    }

    /**
     * Request Matchmaking Meeting (BR-13)
     */
    public function meetingRequestForm(Request $request)
    {
        $event = $this->getActiveEvent();
        $user = auth()->user();
        $organization = $user->organizations()
            ->where('organizations.event_id', $event->id)
            ->where('organizations.status', 'verified')
            ->firstOrFail();
        $organizations = Organization::where('event_id', $event->id)
            ->where('status', 'verified')
            ->where('id', '!=', $organization->id)
            ->orderBy('name')
            ->get();
        $meetings = Meeting::where(function ($query) use ($organization) {
            $query->where('requester_org_id', $organization->id)
                ->orWhere('target_org_id', $organization->id);
        })->with(['requester', 'target', 'project'])->latest('start_time')->get();
        $projectId = $request->query('project_id');
        if ($projectId) {
            abort_unless(Project::where('event_id', $event->id)
                ->where('organization_id', $organization->id)
                ->whereKey($projectId)->exists(), 403);
        }

        return view('portal.meetings', compact('event', 'user', 'organization', 'organizations', 'meetings', 'projectId'));
    }

    public function requestMeeting(Request $request, MeetingService $meetingService)
    {
        $request->validate([
            'target_org_id' => 'required|exists:organizations,id',
            'table_number' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'agenda_topic' => 'required|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $user = auth()->user();
        $event = $this->getActiveEvent();
        $myOrg = $user->organizations()->where('organizations.event_id', $event->id)->where('organizations.status', 'verified')->firstOrFail();
        $targetOrg = Organization::where('event_id', $event->id)->where('status', 'verified')->findOrFail($request->target_org_id);
        if ($request->filled('project_id')) {
            abort_unless(Project::where('event_id', $event->id)->where('organization_id', $myOrg->id)->whereKey($request->project_id)->exists(), 403);
        }

        try {
            $meetingService->scheduleMeeting(
                $event->id,
                $myOrg->id,
                $targetOrg->id,
                $request->table_number,
                $request->start_time,
                $request->end_time,
                $request->agenda_topic,
                $request->project_id
            );

            return back()->with('success', 'Permintaan pertemuan dicatat dengan pemeriksaan bentrok. Panitia akan mengonfirmasi jadwal.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Book School Tour Slot (Section 8)
     */
    public function bookTourSlot(Request $request)
    {
        $request->validate([
            'tour_slot_id' => 'required|exists:tour_slots,id',
            'student_count' => 'required|integer|min:5|max:200',
            'teacher_count' => 'required|integer|min:1|max:20',
        ]);

        $user = auth()->user();
        $event = $this->getActiveEvent();
        $schoolOrg = $user->organizations()->where('organizations.event_id', $event->id)
            ->where('type', 'school')->where('status', 'verified')->firstOrFail();

        $totalGroup = $request->student_count + $request->teacher_count;
        try {
            DB::transaction(function () use ($request, $schoolOrg, $totalGroup, $event) {
                $slot = TourSlot::where('event_id', $event->id)->whereKey($request->tour_slot_id)->lockForUpdate()->firstOrFail();
                if ($slot->status !== 'open' || ($slot->booked_count + $totalGroup) > $slot->max_capacity) {
                    throw new Exception('Slot tur ini sudah ditutup atau kapasitas kuotanya tidak mencukupi.');
                }

                SchoolVisit::create([
                    'tour_slot_id' => $slot->id,
                    'organization_id' => $schoolOrg->id,
                    'student_count' => $request->student_count,
                    'teacher_count' => $request->teacher_count,
                    'pic_name' => $schoolOrg->pic_name,
                    'pic_phone' => $schoolOrg->pic_phone,
                    'qr_group_token' => 'GRP-' . strtoupper(bin2hex(random_bytes(8))),
                    'arrival_status' => 'confirmed',
                    'actual_attendees' => 0,
                    'arrival_notes' => $request->arrival_notes,
                ]);

                $slot->booked_count += $totalGroup;
                if ($slot->booked_count >= $slot->max_capacity) {
                    $slot->status = 'full';
                }
                $slot->save();
            });
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Pendaftaran slot tur sekolah berhasil dikonfirmasi! QR Rombongan telah diterbitkan.');
    }

    /**
     * Support Ticket
     */
    public function submitSupportTicket(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        SupportTicket::create([
            'user_id' => auth()->id(),
            'category' => $request->category,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return back()->with('success', 'Tiket bantuan Anda telah terkirim ke Sekretariat Panitia.');
    }
}
