<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Venue;
use App\Models\Organization;
use App\Models\Booth;
use App\Models\BoothAllocation;
use App\Models\Project;
use App\Models\ProjectVersion;
use App\Models\PublicationApproval;
use App\Models\User;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\CheckInLog;
use App\Models\Meeting;
use App\Models\FollowUp;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\InKindContribution;
use App\Models\JudgeAssignment;
use App\Models\Assessment;
use App\Models\Criterion;
use App\Models\SurveyResponse;
use App\Models\SupportTicket;
use App\Models\SchoolVisit;
use App\Models\TourSlot;
use App\Models\AuditLog;
use App\Models\Task;
use App\Models\Registration;
use App\Models\News;
use App\Services\BoothService;
use App\Services\CheckInService;
use App\Services\JudgingService;
use App\Services\FinanceService;
use App\Services\MeetingService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Exception;

class AdminController extends Controller
{
    protected function getActiveEvent()
    {
        return Event::with('venue')->where('is_active', true)->first() ?? Event::with('venue')->firstOrFail();
    }

    public function dashboard(CheckInService $checkInService, FinanceService $financeService)
    {
        $event = $this->getActiveEvent();

        // 1. Participant & Project KPIs
        $totalCampuses = Organization::where('event_id', $event->id)->where('type', 'campus')->count();
        $totalProjects = Project::where('event_id', $event->id)->count();
        $passedProjects = Project::where('event_id', $event->id)->where('status', 'lolos')->count();
        $publishedProjects = Project::where('event_id', $event->id)->published()->count();
        $pitchFinalists = Project::where('event_id', $event->id)->where('is_pitch_finalist', true)->count();

        // 2. Booth KPIs
        $totalBooths = Booth::where('event_id', $event->id)->count();
        $allocatedBooths = BoothAllocation::where('event_id', $event->id)->whereIn('status', ['confirmed', 'active'])->count();

        // 3. Attendance KPIs (BR-11 & BR-12)
        $attendance = $checkInService->getAttendanceMetrics($event->id);

        // 4. CSAT Satisfaction KPI (Section 14: (score 4 or 5) / total * 100%)
        $totalSurvey = SurveyResponse::where('event_id', $event->id)->count();
        $satisfiedSurvey = SurveyResponse::where('event_id', $event->id)->whereIn('satisfaction_score', [4, 5])->count();
        $csatPercent = $totalSurvey > 0 ? round(($satisfiedSurvey / $totalSurvey) * 100, 1) : 0.0;

        // 5. Finance KPI (BR-08: In-Kind separated from Cash)
        $finance = $financeService->getFinanceSummary($event->id);

        // 6. Collaboration & H+30 KPIs
        $totalMeetings = Meeting::where('event_id', $event->id)->count();
        $totalFollowUps = FollowUp::where('event_id', $event->id)->count();
        $overdueFollowUps = FollowUp::where('event_id', $event->id)->where('status', '!=', 'completed')->where('deadline_h30', '<', now())->count();

        // 7. Recent Tasks & Audits
        $tasks = Task::where('event_id', $event->id)->orderBy('due_date')->take(5)->get();
        $recentAudits = AuditLog::where('event_id', $event->id)->with('user')->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'event',
            'totalCampuses',
            'totalProjects',
            'passedProjects',
            'publishedProjects',
            'pitchFinalists',
            'totalBooths',
            'allocatedBooths',
            'attendance',
            'totalSurvey',
            'satisfiedSurvey',
            'csatPercent',
            'finance',
            'totalMeetings',
            'totalFollowUps',
            'overdueFollowUps',
            'tasks',
            'recentAudits'
        ));
    }

    public function projects(Request $request)
    {
        $event = $this->getActiveEvent();
        $status = $request->query('status');
        $pubStatus = $request->query('pub_status');
        $search = $request->query('q');

        $query = Project::where('event_id', $event->id)->with(['organization', 'team', 'booth']);

        if ($status) $query->where('status', $status);
        if ($pubStatus) $query->where('publication_status', $pubStatus);
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('organization', fn($sub) => $sub->where('name', 'like', "%{$search}%"));
            });
        }

        $projects = $query->paginate(15)->withQueryString();
        $newsItems = News::where('event_id', $event->id)->latest('updated_at')->get();
        $newsCategories = ['CMS', 'Katalog Publik', 'Media', 'Sponsor Publik', 'Dokumentasi'];

        return view('admin.projects', compact('event', 'projects', 'status', 'pubStatus', 'search', 'newsItems', 'newsCategories'));
    }

    public function storeNews(Request $request)
    {
        $event = $this->getActiveEvent();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:CMS,Katalog Publik,Media,Sponsor Publik,Dokumentasi',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string|max:50000',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:20480',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);
        $slugBase = Str::slug($data['title']) ?: 'berita';
        $slug = $slugBase;
        while (News::where('event_id', $event->id)->where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . strtolower(Str::random(5));
        }
        $isPublished = $request->boolean('is_published');
        $news = News::create([
            'event_id' => $event->id,
            'title' => $data['title'],
            'slug' => $slug,
            'category' => $data['category'],
            'excerpt' => $data['excerpt'] ?? null,
            'content' => $data['content'],
            'cover_image' => $request->file('cover_image')?->store('news/covers', 'public'),
            'document_path' => $request->file('document')?->store('news/documents', 'public'),
            'document_name' => $request->file('document')?->getClientOriginalName(),
            'is_published' => $isPublished,
            'published_at' => $isPublished ? ($data['published_at'] ?? now()) : ($data['published_at'] ?? null),
        ]);
        AuditLog::log('news_created', 'News', $news->id, null, [
            'title' => $news->title, 'category' => $news->category,
            'is_published' => $news->is_published, 'has_cover' => (bool) $news->cover_image,
            'has_document' => (bool) $news->document_path,
        ], "Berita {$news->title} dibuat", $event->id);

        return redirect()->route('admin.projects')->with('success', 'Berita berhasil dibuat.');
    }

    public function updateNews(Request $request, $newsId)
    {
        $event = $this->getActiveEvent();
        $news = News::where('event_id', $event->id)->findOrFail($newsId);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:CMS,Katalog Publik,Media,Sponsor Publik,Dokumentasi',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string|max:50000',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:20480',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);
        $old = $news->only(['title', 'category', 'is_published', 'published_at', 'cover_image', 'document_path']);
        $news->title = $data['title'];
        $news->slug = Str::slug($data['title']) ?: 'berita-' . $news->id;
        if (News::where('event_id', $event->id)->where('slug', $news->slug)->where('id', '!=', $news->id)->exists()) {
            $news->slug .= '-' . strtolower(Str::random(5));
        }
        $news->category = $data['category'];
        $news->excerpt = $data['excerpt'] ?? null;
        $news->content = $data['content'];
        $news->is_published = $request->boolean('is_published');
        $news->published_at = $news->is_published ? ($data['published_at'] ?? $news->published_at ?? now()) : ($data['published_at'] ?? $news->published_at);
        if ($request->hasFile('cover_image')) {
            $oldCover = $news->cover_image;
            $news->cover_image = $request->file('cover_image')->store('news/covers', 'public');
        }
        if ($request->hasFile('document')) {
            $oldDocument = $news->document_path;
            $news->document_path = $request->file('document')->store('news/documents', 'public');
            $news->document_name = $request->file('document')->getClientOriginalName();
        }
        $news->save();
        if (!empty($oldCover)) Storage::disk('public')->delete($oldCover);
        if (!empty($oldDocument)) Storage::disk('public')->delete($oldDocument);
        AuditLog::log('news_updated', 'News', $news->id, $old,
            $news->only(['title', 'category', 'is_published', 'published_at', 'cover_image', 'document_path']),
            "Berita {$news->title} diperbarui", $event->id);

        return redirect()->route('admin.projects')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroyNews($newsId)
    {
        $event = $this->getActiveEvent();
        $news = News::where('event_id', $event->id)->findOrFail($newsId);
        $old = $news->only(['title', 'category', 'is_published']);
        if ($news->cover_image) Storage::disk('public')->delete($news->cover_image);
        if ($news->document_path) Storage::disk('public')->delete($news->document_path);
        $news->delete();
        AuditLog::log('news_deleted', 'News', $news->id, $old, null,
            "Berita {$old['title']} dihapus", $event->id);

        return redirect()->route('admin.projects')->with('success', 'Berita berhasil dihapus.');
    }

    public function organizations()
    {
        $event = $this->getActiveEvent();
        $query = Organization::where('event_id', $event->id);
        if (!auth()->user()->isSuperAdmin() && auth()->user()->activeRole?->slug !== 'sekretariat') {
            $types = auth()->user()->activeRole?->slug === 'kampus-sekolah'
                ? ['campus', 'school']
                : ['industry', 'partner', 'sponsor'];
            $query->whereIn('type', $types);
        }
        $organizations = $query->orderByRaw("CASE status WHEN 'pending_verification' THEN 0 ELSE 1 END")
            ->orderBy('name')->get();

        return view('admin.organizations', compact('event', 'organizations'));
    }

    public function verifyOrganization(Request $request, $organizationId)
    {
        $data = $request->validate([
            'status' => 'required|in:verified,rejected',
            'verification_notes' => 'nullable|string|max:2000',
        ]);
        $organization = Organization::where('event_id', $this->getActiveEvent()->id)->findOrFail($organizationId);
        $roleSlug = auth()->user()->activeRole?->slug;
        if (!auth()->user()->isSuperAdmin()) {
            $allowedTypes = match ($roleSlug) {
                'kampus-sekolah' => ['campus', 'school'],
                'industri-sponsor' => ['industry', 'partner', 'sponsor'],
                'sekretariat' => ['campus', 'school', 'industry', 'partner', 'sponsor'],
                default => [],
            };
            abort_unless(in_array($organization->type, $allowedTypes, true), 403);
        }

        $old = ['status' => $organization->status, 'verification_notes' => $organization->verification_notes];
        $organization->update($data);
        $registrationStatus = $data['status'] === 'verified' ? 'verified' : 'cancelled';
        Registration::where('event_id', $organization->event_id)
            ->where('organization_id', $organization->id)
            ->update(['status' => $registrationStatus]);
        AuditLog::log(
            'organization_verification_changed',
            'Organization',
            $organization->id,
            $old,
            ['status' => $organization->status, 'verification_notes' => $organization->verification_notes],
            "Status verifikasi organisasi {$organization->name} diubah menjadi {$organization->status}",
            $organization->event_id
        );

        return back()->with('success', 'Status verifikasi organisasi berhasil diperbarui.');
    }

    public function curateProject(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        $validated = $request->validate([
            'status' => 'required|in:draft,diajukan,dalam_pemeriksaan,perlu_revisi,lolos,tidak_lolos',
            'curator_notes' => 'nullable|required_if:status,perlu_revisi|string|max:4000',
            'is_pitch_finalist' => 'nullable|boolean',
            'pitch_order' => 'nullable|integer|min:1|max:10',
        ]);

        $oldStatus = $project->status;
        $oldLock = $project->is_locked;
        $oldPub = $project->publication_status;
        $newStatus = $validated['status'];

        $project->update([
            'status' => $newStatus,
            'curator_notes' => $validated['curator_notes'] ?? null,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'is_locked' => !in_array($newStatus, ['draft', 'perlu_revisi'], true),
            'is_pitch_finalist' => $request->boolean('is_pitch_finalist'),
            'pitch_order' => $request->boolean('is_pitch_finalist') ? ($validated['pitch_order'] ?? null) : null,
        ]);

        AuditLog::log(
            'project_curated',
            'Project',
            $project->id,
            ['status' => $oldStatus, 'is_locked' => $oldLock, 'publication_status' => $oldPub],
            ['status' => $project->status, 'is_locked' => $project->is_locked, 'publication_status' => $project->publication_status],
            "Kurasi karya ID {$project->id} ({$project->title})",
            $project->event_id
        );

        return back()->with('success', 'Status kurasi diperbarui. Materi dibuka otomatis hanya saat status Perlu Revisi.');
    }

    public function updateProjectPublication(Request $request, $projectId)
    {
        $validated = $request->validate([
            'publication_status' => 'required|in:belum_disetujui,siap_publikasi,terbit,diarsipkan',
            'remarks' => 'nullable|string|max:1000',
        ]);
        $project = Project::where('event_id', $this->getActiveEvent()->id)->findOrFail($projectId);
        $oldStatus = $project->publication_status;

        if ($validated['publication_status'] === 'terbit') {
            if (!$project->is_published_consent || $project->status !== 'lolos') {
                return back()->with('error', 'Karya hanya dapat diterbitkan setelah lolos kurasi dan pemilik memberi izin publikasi.');
            }
            PublicationApproval::updateOrCreate(
                ['project_id' => $project->id],
                [
                    'approved_by' => auth()->id(),
                    'status' => 'approved',
                    'remarks' => $validated['remarks'] ?? 'Disetujui oleh petugas publikasi.',
                    'approved_at' => now(),
                ]
            );
        }

        $project->update(['publication_status' => $validated['publication_status']]);
        AuditLog::log(
            'project_publication_status_changed',
            'Project',
            $project->id,
            ['publication_status' => $oldStatus],
            ['publication_status' => $project->publication_status],
            "Status publikasi karya {$project->title} diubah menjadi {$project->publication_status}",
            $project->event_id
        );

        return back()->with('success', 'Status publikasi karya berhasil diperbarui.');
    }

    public function booths()
    {
        $event = $this->getActiveEvent();
        $booths = Booth::where('event_id', $event->id)->with(['allocation.organization', 'projects'])->orderBy('code')->get();
        $unallocatedOrgs = Organization::where('event_id', $event->id)
            ->where('status', 'verified')
            ->whereIn('type', ['campus', 'industry', 'partner', 'sponsor'])
            ->whereDoesntHave('boothAllocations', fn($q) => $q->whereIn('status', ['confirmed', 'active']))
            ->get();

        return view('admin.booths', compact('event', 'booths', 'unallocatedOrgs'));
    }

    public function allocateBooth(Request $request, BoothService $boothService)
    {
        $request->validate([
            'booth_id' => 'required|exists:booths,id',
            'organization_id' => 'required|exists:organizations,id',
            'notes' => 'nullable|string',
        ]);

        try {
            $event = $this->getActiveEvent();
            $boothService->allocateBooth($event->id, $request->booth_id, $request->organization_id, $request->notes);
            return back()->with('success', 'Alokasi booth berhasil ditetapkan dengan validasi anti-duplikasi (BR-04 & BR-05)!');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function releaseBooth(Request $request, $allocationId, BoothService $boothService)
    {
        try {
            $boothService->releaseBooth($allocationId);
            return back()->with('success', 'Alokasi booth berhasil dibatalkan dan booth kembali tersedia.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function finance(FinanceService $financeService)
    {
        $event = $this->getActiveEvent();
        $invoices = Invoice::where('event_id', $event->id)->with(['organization', 'payments', 'items'])->latest()->get();
        $invoiceOrganizations = Organization::where('event_id', $event->id)->where('status', 'verified')->orderBy('name')->get();
        $pendingPayments = Payment::whereHas('invoice', fn($q) => $q->where('event_id', $event->id))
            ->where('status', 'pending_verification')
            ->with(['invoice.organization', 'invoice.items'])
            ->get();
        $verifiedPayments = Payment::whereHas('invoice', fn($q) => $q->where('event_id', $event->id))
            ->where('status', 'verified')
            ->with(['invoice.organization', 'verifier', 'allocations.invoiceItem'])
            ->latest()
            ->take(15)
            ->get();
        $inKindContributions = InKindContribution::whereHas('organization', fn($q) => $q->where('event_id', $event->id))
            ->with('organization')
            ->get();
        $expenses = Expense::where('event_id', $event->id)->with('approver')->latest()->get();
        $summary = $financeService->getFinanceSummary($event->id);

        return view('admin.finance', compact('event', 'invoices', 'invoiceOrganizations', 'pendingPayments', 'verifiedPayments', 'inKindContributions', 'expenses', 'summary'));
    }

    public function storeInvoice(Request $request)
    {
        $event = $this->getActiveEvent();
        $data = $request->validate([
            'organization_id' => 'required|integer|exists:organizations,id',
            'invoice_number' => 'nullable|string|max:100|unique:invoices,invoice_number',
            'description' => 'required|string|max:255',
            'subtotal' => 'required|numeric|min:0.01',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'due_date' => 'required|date',
            'notes' => 'nullable|string|max:2000',
        ]);
        $organization = Organization::where('event_id', $event->id)->where('status', 'verified')->findOrFail($data['organization_id']);
        $discount = (float) ($data['discount'] ?? 0);
        $tax = (float) ($data['tax'] ?? 0);
        if ($discount > (float) $data['subtotal']) {
            return back()->withInput()->withErrors(['discount' => 'Diskon tidak boleh melebihi subtotal.']);
        }
        $total = (float) $data['subtotal'] - $discount + $tax;
        if ($total <= 0) {
            return back()->withInput()->withErrors(['subtotal' => 'Total tagihan harus lebih dari nol.']);
        }

        DB::transaction(function () use ($data, $event, $organization, $discount, $tax, $total) {
            $invoice = Invoice::create([
                'event_id' => $event->id,
                'organization_id' => $organization->id,
                'invoice_number' => ($data['invoice_number'] ?? null) ?: 'INV/' . $event->edition . '/' . now()->format('ymd') . '/' . strtoupper(bin2hex(random_bytes(3))),
                'subtotal' => $data['subtotal'],
                'discount' => $discount,
                'tax' => $tax,
                'total_amount' => $total,
                'due_date' => $data['due_date'],
                'status' => 'unpaid',
                'notes' => $data['notes'] ?? null,
            ]);
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $data['description'],
                'quantity' => 1,
                'unit_price' => $data['subtotal'],
                'total_price' => $data['subtotal'],
            ]);
            AuditLog::log('invoice_created', 'Invoice', $invoice->id, null, [
                'organization_id' => $organization->id,
                'invoice_number' => $invoice->invoice_number,
                'total_amount' => $invoice->total_amount,
                'due_date' => $invoice->due_date?->toDateString(),
            ], "Tagihan {$invoice->invoice_number} dibuat untuk {$organization->name}", $event->id);
        });

        return back()->with('success', 'Tagihan organisasi berhasil dibuat dan akan tampil di portal organisasi.');
    }

    public function updateInvoice(Request $request, $invoiceId)
    {
        $event = $this->getActiveEvent();
        $invoice = Invoice::where('event_id', $event->id)->findOrFail($invoiceId);
        $data = $request->validate([
            'description' => 'required|string|max:255',
            'subtotal' => 'required|numeric|min:0.01',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'due_date' => 'required|date',
            'notes' => 'nullable|string|max:2000',
        ]);
        $discount = (float) ($data['discount'] ?? 0);
        $tax = (float) ($data['tax'] ?? 0);
        if ($discount > (float) $data['subtotal']) {
            return back()->withInput()->withErrors(['discount' => 'Diskon tidak boleh melebihi subtotal.']);
        }
        $total = (float) $data['subtotal'] - $discount + $tax;
        $reservedAmount = (float) $invoice->payments()->whereIn('status', ['verified', 'pending_verification'])->sum('amount');
        if ($total <= 0 || $total < $reservedAmount) {
            return back()->withInput()->withErrors(['subtotal' => 'Total baru tidak boleh lebih kecil dari pembayaran terverifikasi atau menunggu verifikasi (' . number_format($reservedAmount, 0, ',', '.') . ').']);
        }

        try {
        DB::transaction(function () use ($invoice, $data, $discount, $tax, $total, $event) {
            $lockedInvoice = Invoice::whereKey($invoice->id)->lockForUpdate()->firstOrFail();
            $old = [
                'subtotal' => $lockedInvoice->subtotal,
                'discount' => $lockedInvoice->discount,
                'tax' => $lockedInvoice->tax,
                'total_amount' => $lockedInvoice->total_amount,
                'due_date' => $lockedInvoice->due_date?->toDateString(),
                'notes' => $lockedInvoice->notes,
            ];
            $verifiedTotal = (float) $lockedInvoice->payments()->where('status', 'verified')->sum('amount');
            $pendingTotal = (float) $lockedInvoice->payments()->where('status', 'pending_verification')->sum('amount');
            if ($total < ($verifiedTotal + $pendingTotal)) {
                throw new Exception('Total tagihan tidak dapat dikurangi karena pembayaran yang sudah masuk melebihi total baru.');
            }

            $status = $verifiedTotal >= $total ? 'paid' : ($verifiedTotal > 0 ? 'partially_paid' : 'unpaid');
            $lockedInvoice->update([
                'subtotal' => $data['subtotal'],
                'discount' => $discount,
                'tax' => $tax,
                'total_amount' => $total,
                'due_date' => $data['due_date'],
                'status' => $status,
                'notes' => $data['notes'] ?? null,
            ]);
            $item = $lockedInvoice->items()->oldest('id')->first();
            if ($item) {
                $item->update([
                    'description' => $data['description'],
                    'quantity' => 1,
                    'unit_price' => $data['subtotal'],
                    'total_price' => $data['subtotal'],
                ]);
            } else {
                InvoiceItem::create([
                    'invoice_id' => $lockedInvoice->id,
                    'description' => $data['description'],
                    'quantity' => 1,
                    'unit_price' => $data['subtotal'],
                    'total_price' => $data['subtotal'],
                ]);
            }
            AuditLog::log('invoice_updated', 'Invoice', $lockedInvoice->id, $old, [
                'subtotal' => $lockedInvoice->subtotal,
                'discount' => $lockedInvoice->discount,
                'tax' => $lockedInvoice->tax,
                'total_amount' => $lockedInvoice->total_amount,
                'due_date' => $lockedInvoice->due_date?->toDateString(),
                'notes' => $lockedInvoice->notes,
            ], "Tagihan {$lockedInvoice->invoice_number} diperbarui", $event->id);
        });
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Tagihan berhasil diperbarui. Pembayaran yang sudah tercatat tetap dipertahankan.');
    }

    public function verifyPayment(Request $request, $paymentId, FinanceService $financeService)
    {
        $data = $request->validate([
            'allocations' => 'nullable|array',
            'allocations.*.invoice_item_id' => 'required|integer|exists:invoice_items,id',
            'allocations.*.amount' => 'nullable|numeric|min:0',
        ]);
        $allocations = collect($data['allocations'] ?? [])
            ->filter(fn ($allocation) => (float) ($allocation['amount'] ?? 0) > 0)
            ->values()
            ->all();
        try {
            $financeService->verifyPayment($paymentId, auth()->id(), $allocations);
            return back()->with('success', 'Pembayaran berhasil diverifikasi dan dialokasikan ke tagihan resmi (BR-06 & BR-07)!');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function downloadPaymentReceipt($paymentId)
    {
        $event = $this->getActiveEvent();
        $payment = Payment::whereKey($paymentId)
            ->whereHas('invoice', fn ($query) => $query->where('event_id', $event->id))
            ->firstOrFail();
        abort_unless($payment->receipt_file && Storage::disk('local')->exists($payment->receipt_file), 404);

        return Storage::disk('local')->download($payment->receipt_file);
    }

    public function checkIn(Request $request, CheckInService $checkInService)
    {
        $event = $this->getActiveEvent();
        $metrics = $checkInService->getAttendanceMetrics($event->id);
        $recentLogs = CheckInLog::where('event_id', $event->id)
            ->with(['ticket', 'user', 'scanner'])
            ->latest('scanned_at')
            ->take(15)
            ->get();
        $search = trim((string) $request->query('q', ''));
        $participants = Ticket::where('event_id', $event->id)
            ->with('user')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('ticket_number', 'like', "%{$search}%")
                        ->orWhereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%"));
                });
            })
            ->latest('created_at')
            ->paginate(10, ['*'], 'participants_page')
            ->withQueryString();
        $checkInQueueQuery = Ticket::where('event_id', $event->id)
            ->where('status', 'active')
            ->where('has_checked_in', false);
        $checkInQueueCount = (clone $checkInQueueQuery)->count();
        $checkInQueue = $checkInQueueQuery
            ->with('user')
            ->oldest('created_at')
            ->take(10)
            ->get();
        $supportTickets = SupportTicket::with(['user', 'responder'])
            ->whereIn('status', ['open', 'in_review'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.checkin', compact('event', 'metrics', 'recentLogs', 'search', 'participants', 'checkInQueue', 'checkInQueueCount', 'supportTickets'));
    }

    public function updateCheckinSupportTicket(Request $request, $ticketId)
    {
        $ticket = SupportTicket::findOrFail($ticketId);
        $data = $request->validate([
            'status' => 'required|in:in_review,answered,closed',
            'response_text' => 'nullable|string|max:2000|required_if:status,answered',
        ]);
        $old = $ticket->only(['status', 'response_text', 'responded_by', 'responded_at']);
        $ticket->status = $data['status'];
        if ($data['status'] === 'answered') {
            $ticket->response_text = $data['response_text'];
            $ticket->responded_by = auth()->id();
            $ticket->responded_at = now();
        } elseif ($data['status'] === 'in_review') {
            $ticket->responded_by = auth()->id();
            $ticket->responded_at = now();
        }
        $ticket->save();
        AuditLog::log('support_ticket_updated', 'SupportTicket', $ticket->id, $old,
            $ticket->only(['status', 'response_text', 'responded_by', 'responded_at']),
            "Tiket bantuan {$ticket->ticket_code} diperbarui", $this->getActiveEvent()->id);

        return back()->with('success', 'Tiket bantuan berhasil diperbarui.');
    }

    public function tourSlots()
    {
        $event = $this->getActiveEvent();
        $slots = TourSlot::where('event_id', $event->id)
            ->withCount('visits')
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('admin.tours', compact('event', 'slots'));
    }

    public function storeTourSlot(Request $request)
    {
        $data = $request->validate([
            'slot_name' => 'required|string|max:100',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_capacity' => 'required|integer|min:1|max:2000',
            'guide_name' => 'nullable|string|max:255',
            'status' => 'required|in:open,closed',
        ]);
        $event = $this->getActiveEvent();

        if ($event->start_date && $data['date'] < $event->start_date->toDateString()) {
            return back()->withInput()->withErrors(['date' => 'Tanggal slot tidak boleh sebelum tanggal acara.']);
        }
        if ($event->end_date && $data['date'] > $event->end_date->toDateString()) {
            return back()->withInput()->withErrors(['date' => 'Tanggal slot tidak boleh setelah tanggal acara.']);
        }

        $slot = TourSlot::create($data + [
            'event_id' => $event->id,
            'booked_count' => 0,
        ]);
        AuditLog::log('tour_slot_created', 'TourSlot', $slot->id, null, $slot->only([
            'slot_name', 'date', 'start_time', 'end_time', 'max_capacity', 'guide_name', 'status',
        ]), "Slot tur {$slot->slot_name} dibuat", $event->id);

        return back()->with('success', 'Slot tur sekolah berhasil dibuat.');
    }

    public function updateTourSlot(Request $request, $slotId)
    {
        $event = $this->getActiveEvent();
        $slot = TourSlot::where('event_id', $event->id)->findOrFail($slotId);
        $data = $request->validate([
            'slot_name' => 'required|string|max:100',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_capacity' => 'required|integer|min:' . max(1, $slot->booked_count) . '|max:2000',
            'guide_name' => 'nullable|string|max:255',
            'status' => 'required|in:open,closed,full',
        ]);

        if ($event->start_date && $data['date'] < $event->start_date->toDateString()) {
            return back()->withInput()->withErrors(['date' => 'Tanggal slot tidak boleh sebelum tanggal acara.']);
        }
        if ($event->end_date && $data['date'] > $event->end_date->toDateString()) {
            return back()->withInput()->withErrors(['date' => 'Tanggal slot tidak boleh setelah tanggal acara.']);
        }

        $old = $slot->only(['slot_name', 'date', 'start_time', 'end_time', 'max_capacity', 'guide_name', 'status']);
        $slot->update($data);
        AuditLog::log('tour_slot_updated', 'TourSlot', $slot->id, $old, $slot->only(array_keys($old)), "Slot tur {$slot->slot_name} diperbarui", $event->id);

        return back()->with('success', 'Slot tur sekolah berhasil diperbarui.');
    }

    public function processScan(Request $request, CheckInService $checkInService)
    {
        $request->merge(['qr_token' => trim((string) $request->input('qr_token'))]);

        $request->validate([
            'qr_token' => 'required|string',
            'scan_type' => 'required|in:in,out',
            'gate' => 'nullable|string',
            'is_manual' => 'nullable|boolean',
            'reason' => 'nullable|required_if:is_manual,1|string|max:1000',
            'actual_attendees' => 'nullable|integer|min:1|max:500',
        ]);

        try {
            $event = $this->getActiveEvent();
            $schoolVisit = SchoolVisit::where('qr_group_token', $request->qr_token)
                ->whereHas('tourSlot', fn ($query) => $query->where('event_id', $event->id))
                ->first();
            if ($schoolVisit) {
                if (!$request->filled('actual_attendees')) {
                    return back()->with('error', 'QR rombongan terdeteksi. Masukkan jumlah orang yang benar-benar hadir, lalu pindai kembali.');
                }
                $visit = $checkInService->checkInSchoolGroup($request->qr_token, (int) $request->actual_attendees, auth()->id());
                return back()->with('group_scan_result', $visit);
            }

            $res = $checkInService->scanQrToken(
                $request->qr_token,
                $request->scan_type,
                $request->input('gate', 'Gate Utama Sabuga'),
                auth()->id(),
                $request->boolean('is_manual'),
                $request->reason
            );

            return back()->with('scan_result', $res);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function judging(JudgingService $judgingService)
    {
        $event = $this->getActiveEvent();
        $leaderboard = $judgingService->getLeaderboard($event->id, false);
        $judges = User::where('status', 'active')
            ->whereHas('roles', fn ($query) => $query->where('slug', 'juri'))
            ->orderBy('name')
            ->get();
        $assignableProjects = Project::where('event_id', $event->id)
            ->where('status', 'lolos')
            ->orderBy('title')
            ->get();
        $judgeAssignments = JudgeAssignment::where('event_id', $event->id)
            ->with(['judge', 'project', 'assessment'])
            ->orderByDesc('is_active')
            ->orderBy('user_id')
            ->get();
        $criteria = Criterion::whereHas('rubricVersion', fn ($query) => $query->where('event_id', $event->id)->where('is_active', true))
            ->orderBy('sort_order')->get();
        $assessments = Assessment::whereHas('project', fn($q) => $q->where('event_id', $event->id))
            ->with(['project.organization', 'judge'])
            ->get();

        return view('admin.judging', compact('event', 'leaderboard', 'criteria', 'assessments', 'judges', 'assignableProjects', 'judgeAssignments'));
    }

    public function assignJudge(Request $request)
    {
        $data = $request->validate([
            'judge_id' => 'required|integer|exists:users,id',
            'project_id' => 'required|integer|exists:projects,id',
        ]);
        $event = $this->getActiveEvent();
        $judge = User::where('status', 'active')
            ->whereHas('roles', fn ($query) => $query->where('slug', 'juri'))
            ->findOrFail($data['judge_id']);
        $project = Project::where('event_id', $event->id)
            ->where('status', 'lolos')
            ->findOrFail($data['project_id']);

        $assignment = JudgeAssignment::where('event_id', $event->id)
            ->where('user_id', $judge->id)
            ->where('project_id', $project->id)
            ->first();

        if ($assignment?->is_active) {
            return back()->with('error', 'Juri tersebut sudah ditugaskan untuk karya ini.');
        }
        if ($assignment?->has_conflict_of_interest) {
            return back()->with('error', 'Juri pernah melaporkan konflik kepentingan untuk karya ini. Pilih juri lain.');
        }

        if ($assignment) {
            $assignment->update(['is_active' => true]);
        } else {
            $assignment = JudgeAssignment::create([
                'event_id' => $event->id,
                'user_id' => $judge->id,
                'project_id' => $project->id,
                'is_active' => true,
            ]);
        }

        AuditLog::log(
            'judge_assigned',
            'JudgeAssignment',
            $assignment->id,
            null,
            ['judge_id' => $judge->id, 'project_id' => $project->id, 'is_active' => true],
            "Juri {$judge->name} ditugaskan ke karya {$project->title}",
            $event->id
        );

        return back()->with('success', "{$judge->name} berhasil ditugaskan ke karya “{$project->title}”.");
    }

    public function unlockScore(Request $request, $assessmentId, JudgingService $judgingService)
    {
        $data = $request->validate(['reason' => 'required|string|min:8|max:1000']);
        $assessment = Assessment::whereHas('project', fn ($query) => $query->where('event_id', $this->getActiveEvent()->id))
            ->findOrFail($assessmentId);

        try {
            $judgingService->unlockAssessment($assessment->id, $data['reason'], auth()->id());
            return back()->with('success', 'Kunci penilaian berhasil dibuka dengan pencatatan audit log.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function togglePublishResults(Request $request)
    {
        $event = $this->getActiveEvent();
        $newState = !$event->is_results_published;
        if ($newState) {
            $activeRubric = \App\Models\RubricVersion::where('event_id', $event->id)->where('is_active', true)->first();
            $criterionIds = $activeRubric?->criteria()->pluck('criteria.id') ?? collect();
            $assignments = JudgeAssignment::where('event_id', $event->id)
                ->where('is_active', true)
                ->whereHas('project', fn ($query) => $query->where('event_id', $event->id))
                ->with(['assessment.scores' => fn ($query) => $query->whereIn('criterion_id', $criterionIds)])
                ->get();
            $allAssessmentsComplete = $assignments->isNotEmpty()
                && $criterionIds->isNotEmpty()
                && $assignments->every(function ($assignment) use ($criterionIds) {
                    $assessment = $assignment->assessment;
                    return $assessment
                        && $assessment->status === 'locked'
                        && (int) $assessment->project_id === (int) $assignment->project_id
                        && $assessment->scores->count() === $criterionIds->count();
                });
            if (!$allAssessmentsComplete) {
                return back()->with('error', 'Hasil belum dapat diterbitkan. Pastikan ada penugasan aktif dan seluruh penilaian wajib sudah dikunci.');
            }
        }
        $event->update(['is_results_published' => $newState]);

        AuditLog::log(
            'results_publication_toggled',
            'Event',
            $event->id,
            ['is_results_published' => !$newState],
            ['is_results_published' => $newState],
            $newState ? "Pengesahan publikasi pemenang FUTURiSE 2026 ke publik" : "Pencabutan publikasi pemenang",
            $event->id
        );

        return back()->with('success', $newState ? 'Hasil dewan juri RESMI DIPUBLIKASIKAN ke publik!' : 'Hasil ditarik kembali dari publik.');
    }

    public function meetings()
    {
        $event = $this->getActiveEvent();
        $meetings = Meeting::where('event_id', $event->id)->with(['requester', 'target', 'project'])->orderBy('start_time')->get();
        $organizations = Organization::where('event_id', $event->id)->where('status', 'verified')->orderBy('name')->get();

        return view('admin.meetings', compact('event', 'meetings', 'organizations'));
    }

    public function scheduleMeetingManual(Request $request, MeetingService $meetingService)
    {
        $data = $request->validate([
            'requester_org_id' => 'required|integer',
            'target_org_id' => 'required|integer|different:requester_org_id',
            'table_number' => 'required|string|max:100',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'agenda_topic' => 'required|string|max:255',
        ]);
        $event = $this->getActiveEvent();
        $requester = Organization::where('event_id', $event->id)->where('status', 'verified')->findOrFail($data['requester_org_id']);
        $target = Organization::where('event_id', $event->id)->where('status', 'verified')->findOrFail($data['target_org_id']);

        try {
            $meetingService->scheduleMeeting(
                $event->id,
                $requester->id,
                $target->id,
                $data['table_number'],
                $data['start_time'],
                $data['end_time'],
                $data['agenda_topic'],
                null,
                true
            );
            return back()->with('success', 'Pertemuan berhasil dijadwalkan setelah pemeriksaan bentrok.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateMeetingStatus(Request $request, $meetingId, MeetingService $meetingService)
    {
        $data = $request->validate(['status' => 'required|in:confirmed,cancelled']);
        $meeting = Meeting::where('event_id', $this->getActiveEvent()->id)->findOrFail($meetingId);

        try {
            $meetingService->updateMeetingStatus($meeting->id, $data['status'], auth()->id());
            return back()->with('success', 'Status pertemuan berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function followUps()
    {
        $event = $this->getActiveEvent();
        $followUps = FollowUp::where('event_id', $event->id)->with(['organization', 'project', 'meeting', 'pic'])->orderBy('deadline_h30')->get();

        return view('admin.followups', compact('event', 'followUps'));
    }

    public function updateFollowUp(Request $request, $id)
    {
        $fu = FollowUp::findOrFail($id);
        $fu->update($request->only(['status', 'action_plan', 'result_summary', 'h30_notes', 'deadline_h30']));

        if ($request->status === 'completed' && !$fu->completed_at) {
            $fu->update(['completed_at' => now()]);
        }

        return back()->with('success', 'Status tindak lanjut H+30 berhasil diperbarui!');
    }

    public function settings()
    {
        $event = $this->getActiveEvent();
        return view('admin.settings', compact('event'));
    }

    public function updateSettings(Request $request)
    {
        $event = $this->getActiveEvent();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'theme' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'voting_start_at' => 'nullable|required_with:voting_end_at|date_format:Y-m-d\\TH:i',
            'voting_end_at' => 'nullable|required_with:voting_start_at|date_format:Y-m-d\\TH:i|after:voting_start_at',
            'venue_name' => 'nullable|string',
            'venue_address' => 'nullable|string',
            'quota_campus' => 'required|integer',
            'quota_industry' => 'required|integer',
            'quota_partner' => 'required|integer',
            'target_visitors' => 'required|integer',
            'target_satisfaction_rate' => 'required|numeric',
            'min_survey_responses' => 'required|integer',
            'is_date_confirmed' => 'required|boolean',
        ]);

        foreach (['voting_start_at', 'voting_end_at'] as $field) {
            $data[$field] = filled($data[$field] ?? null)
                ? Carbon::createFromFormat('Y-m-d\\TH:i', $data[$field], 'Asia/Jakarta')->utc()
                : null;
        }

        $oldVotingPeriod = [
            'voting_start_at' => $event->voting_start_at?->toIso8601String(),
            'voting_end_at' => $event->voting_end_at?->toIso8601String(),
        ];
        $event->update($data);
        AuditLog::log(
            'voting_period_updated',
            'Event',
            $event->id,
            $oldVotingPeriod,
            [
                'voting_start_at' => $event->voting_start_at?->toIso8601String(),
                'voting_end_at' => $event->voting_end_at?->toIso8601String(),
            ],
            'Periode voting People\'s Choice diperbarui',
            $event->id
        );

        return back()->with('success', 'Pengaturan acara berhasil diperbarui!');
    }

    public function auditLogs()
    {
        $event = $this->getActiveEvent();
        $logs = AuditLog::where('event_id', $event->id)->with('user')->latest()->paginate(25);

        return view('admin.audit', compact('event', 'logs'));
    }

    /**
     * CSV Exporter (Section 15 & Acceptance 12)
     */
    public function export($type)
    {
        $allowedRoles = match ($type) {
            'projects' => ['super-admin', 'program-kurasi'],
            'checkins' => ['super-admin', 'registrasi-layanan'],
            'finance' => ['super-admin', 'ketua-pelaksana', 'keuangan'],
            default => abort(404),
        };
        abort_unless(auth()->user()->hasRole($allowedRoles), 403);

        $event = $this->getActiveEvent();
        $filename = "futurise-{$type}-" . date('Ymd-His') . ".csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        return response()->stream(function () use ($type, $event) {
            $file = fopen('php://output', 'w');

            if ($type === 'projects') {
                fputcsv($file, ['ID', 'Kampus', 'Judul Karya', 'Kategori', 'Booth', 'Status Kurasi', 'Publikasi', 'Nilai Rata-rata Juri', 'Finalis Pitching']);
                foreach (Project::where('event_id', $event->id)->with(['organization', 'booth'])->get() as $p) {
                    fputcsv($file, [
                        $p->id,
                        $p->organization->name,
                        $p->title,
                        $p->category,
                        $p->booth?->code ?? '-',
                        $p->status,
                        $p->publication_status,
                        $p->averageScore(),
                        $p->is_pitch_finalist ? 'Ya' : 'Tidak',
                    ]);
                }
            } elseif ($type === 'checkins') {
                fputcsv($file, ['ID', 'Nama', 'Kategori', 'Nomor Tiket', 'Tipe Scan', 'Masuk Pertama Unik', 'Lokasi Gate', 'Waktu Scan']);
                foreach (CheckInLog::where('event_id', $event->id)->with(['user', 'ticket'])->get() as $c) {
                    fputcsv($file, [
                        $c->id,
                        $c->user->name,
                        $c->ticket?->category ?? 'visitor',
                        $c->ticket?->ticket_number ?? '-',
                        strtoupper($c->scan_type),
                        $c->is_unique_first_entry ? 'YA (Pengunjung Unik)' : 'TIDAK (Scan Ulang)',
                        $c->gate_location,
                        $c->scanned_at->format('Y-m-d H:i:s'),
                    ]);
                }
            } elseif ($type === 'finance') {
                fputcsv($file, ['No Invoice', 'Organisasi', 'Tipe', 'Total Tagihan', 'Total Terbayar', 'Status']);
                foreach (Invoice::where('event_id', $event->id)->with('organization')->get() as $inv) {
                    fputcsv($file, [
                        $inv->invoice_number,
                        $inv->organization->name,
                        $inv->organization->type,
                        $inv->total_amount,
                        $inv->totalPaid(),
                        $inv->status,
                    ]);
                }
            }

            fclose($file);
        }, 200, $headers);
    }
}
