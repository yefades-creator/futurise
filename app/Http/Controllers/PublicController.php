<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Project;
use App\Models\Organization;
use App\Models\EventSession;
use App\Models\Speaker;
use App\Models\Booth;
use App\Models\SponsorshipPackage;
use App\Models\SponsorshipAgreement;
use App\Models\InKindContribution;
use App\Models\News;
use App\Models\Faq;
use App\Models\Document;
use App\Models\ProjectFeedback;
use App\Models\SurveyResponse;
use App\Models\Meeting;
use App\Models\Ticket;
use App\Services\VotingService;
use App\Services\MeetingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class PublicController extends Controller
{
    protected function getActiveEvent()
    {
        return Event::with('venue')->where('is_active', true)->first() ?? Event::with('venue')->firstOrFail();
    }

    public function home()
    {
        $event = $this->getActiveEvent();
        
        // Featured published projects (BR-11 Acceptance: only published & consented)
        $featuredProjects = Project::where('event_id', $event->id)
            ->published()
            ->with(['organization', 'team'])
            ->orderByDesc('is_pitch_finalist')
            ->take(6)
            ->get();

        // 7 Featured Sessions
        $sessions = EventSession::where('event_id', $event->id)
            ->with('speakers')
            ->orderBy('start_time')
            ->take(7)
            ->get();

        // Confirmed Sponsors (BR-15: only agreed/signed)
        $sponsorAgreements = SponsorshipAgreement::where('event_id', $event->id)
            ->whereIn('status', ['agreed', 'signed'])
            ->with(['organization', 'package'])
            ->get();

        $news = News::where('event_id', $event->id)
            ->where('is_published', true)
            ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('public.home', compact('event', 'featuredProjects', 'sessions', 'sponsorAgreements', 'news'));
    }

    public function about()
    {
        $event = $this->getActiveEvent();
        return view('public.about', compact('event'));
    }

    public function agenda(Request $request)
    {
        $event = $this->getActiveEvent();
        $type = $request->query('type');

        $query = EventSession::where('event_id', $event->id)->with('speakers');
        if ($type) {
            $query->where('type', $type);
        }
        $sessions = $query->orderBy('start_time')->get();

        // 10 Pitching Finalists
        $pitchFinalists = Project::where('event_id', $event->id)
            ->pitchFinalists()
            ->with(['organization', 'team'])
            ->get();

        return view('public.agenda', compact('event', 'sessions', 'pitchFinalists', 'type'));
    }

    public function showcase(Request $request)
    {
        $event = $this->getActiveEvent();
        $search = $request->query('q');
        $category = $request->query('category');
        $campusId = $request->query('campus_id');

        // BR-11 Acceptance: Only published and consented projects
        $query = Project::where('event_id', $event->id)
            ->published()
            ->with(['organization', 'team', 'booth']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('technology_stack', 'like', "%{$search}%")
                  ->orWhere('solution_description', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($campusId) {
            $query->where('organization_id', $campusId);
        }

        $projects = $query->paginate(12)->withQueryString();

        $campuses = Organization::where('event_id', $event->id)
            ->where('type', 'campus')
            ->orderBy('name')
            ->get();

        $categories = ['AI/IoT', 'Smart City', 'FinTech', 'EdTech', 'HealthTech', 'Creative Media'];

        return view('public.showcase', compact('event', 'projects', 'campuses', 'categories', 'search', 'category', 'campusId'));
    }

    public function projectDetail($slug)
    {
        $event = $this->getActiveEvent();
        
        // BR-11 Acceptance: Must be published or author/panitia
        $project = Project::where('event_id', $event->id)
            ->where('slug', $slug)
            ->published()
            ->with(['organization', 'team.members', 'booth', 'feedbacks' => fn ($query) => $query->where('is_public', true)])
            ->firstOrFail();

        $project->increment('view_count');

        // Check if current user has voted (BR-14)
        $hasVoted = false;
        $canVote = false;
        $votingPeriodOpen = (!$event->voting_start_at || now()->gte($event->voting_start_at))
            && (!$event->voting_end_at || now()->lt($event->voting_end_at));
        if (auth()->check()) {
            $hasVoted = \App\Models\Vote::where('event_id', $event->id)
                ->where('user_id', auth()->id())
                ->exists();

            $canVote = $votingPeriodOpen && Ticket::where('event_id', $event->id)
                ->where('user_id', auth()->id())
                ->where('status', 'checked_in')
                ->where('has_checked_in', true)
                ->exists();
        }

        // Related projects from same category
        $relatedProjects = Project::where('event_id', $event->id)
            ->published()
            ->where('category', $project->category)
            ->where('id', '!=', $project->id)
            ->take(3)
            ->get();

        return view('public.project-detail', compact('event', 'project', 'hasVoted', 'canVote', 'votingPeriodOpen', 'relatedProjects'));
    }

    public function industries()
    {
        $event = $this->getActiveEvent();

        $industries = Organization::where('event_id', $event->id)
            ->whereIn('type', ['industry', 'partner'])
            ->with(['companyProfile', 'allocatedBooth'])
            ->orderBy('name')
            ->get();

        return view('public.industries', compact('event', 'industries'));
    }

    public function sponsors()
    {
        $event = $this->getActiveEvent();

        $packages = SponsorshipPackage::where('event_id', $event->id)
            ->where('is_active', true)
            ->with('benefits')
            ->get();

        $confirmedSponsors = SponsorshipAgreement::where('event_id', $event->id)
            ->whereIn('status', ['agreed', 'signed'])
            ->with(['organization', 'package'])
            ->get();

        $inKindContributions = InKindContribution::whereHas('agreement', fn($q) => $q->where('event_id', $event->id))
            ->with('organization')
            ->get();

        return view('public.sponsors', compact('event', 'packages', 'confirmedSponsors', 'inKindContributions'));
    }

    public function participantInfo()
    {
        $event = $this->getActiveEvent();
        $faqs = Faq::where('is_published', true)->orderBy('sort_order')->get();
        $documents = Document::where('event_id', $event->id)->where('is_public', true)->get();

        return view('public.participant-info', compact('event', 'faqs', 'documents'));
    }

    public function venue()
    {
        $event = $this->getActiveEvent();
        $booths = Booth::where('event_id', $event->id)
            ->with(['allocation.organization', 'projects'])
            ->orderBy('code')
            ->get();

        return view('public.venue', compact('event', 'booths'));
    }

    public function news()
    {
        $event = $this->getActiveEvent();
        $categories = ['CMS', 'Katalog Publik', 'Media', 'Sponsor Publik', 'Dokumentasi'];
        $category = request()->query('category');
        $newsList = News::where('event_id', $event->id)
            ->where('is_published', true)
            ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->when(in_array($category, $categories, true), fn ($query) => $query->where('category', $category))
            ->orderByDesc('published_at')
            ->paginate(6)
            ->withQueryString();

        return view('public.news', compact('event', 'newsList', 'categories', 'category'));
    }

    public function newsDetail($slug)
    {
        $event = $this->getActiveEvent();
        $news = News::where('event_id', $event->id)
            ->where('slug', $slug)
            ->where('is_published', true)
            ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->firstOrFail();

        $recentNews = News::where('event_id', $event->id)
            ->where('is_published', true)
            ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->where('id', '!=', $news->id)
            ->take(3)
            ->get();

        return view('public.news-detail', compact('event', 'news', 'recentNews'));
    }

    public function downloadNewsDocument($slug)
    {
        $news = News::where('event_id', $this->getActiveEvent()->id)
            ->where('slug', $slug)
            ->where('is_published', true)
            ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->firstOrFail();
        abort_unless($news->document_path && Storage::disk('public')->exists($news->document_path), 404);

        return Storage::disk('public')->download($news->document_path, $news->document_name ?: basename($news->document_path));
    }

    public function contact()
    {
        $event = $this->getActiveEvent();
        return view('public.contact', compact('event'));
    }

    public function submitFeedback(Request $request, $projectId)
    {
        $request->validate([
            'giver_name' => 'required|string|max:100',
            'giver_category' => 'required|in:visitor,industry,academic,judge,student',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'suggestion' => 'nullable|string|max:1000',
        ]);

        $project = Project::where('event_id', $this->getActiveEvent()->id)->published()->findOrFail($projectId);

        ProjectFeedback::create([
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'giver_category' => $request->giver_category,
            'giver_name' => $request->giver_name,
            'giver_organization' => $request->giver_organization,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'suggestion' => $request->suggestion,
            'is_public' => $request->boolean('publish_feedback'),
        ]);

        return back()->with('success', 'Terima kasih! Feedback dan masukan berharga Anda telah berhasil dikirimkan.');
    }

    public function submitVote(Request $request, $projectId, VotingService $votingService)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk memberikan suara.');
        }

        try {
            $event = $this->getActiveEvent();
            $votingService->castVote($event->id, auth()->id(), $projectId);
            return back()->with('success', 'Suara Anda untuk People\'s Choice Award berhasil dicatat! Terima kasih telah berpartisipasi.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function submitSurvey(Request $request)
    {
        $request->validate([
            'satisfaction_score' => 'required|integer|min:1|max:5',
            'feedback_text' => 'nullable|string|max:1000',
        ]);

        $event = $this->getActiveEvent();
        $ticket = Ticket::where('event_id', $event->id)
            ->where('user_id', auth()->id())
            ->where('has_checked_in', true)
            ->first();
        if (!$ticket) {
            return back()->with('error', 'Survei dapat dikirim setelah tiket Anda tercatat check-in.');
        }
        if (SurveyResponse::where('event_id', $event->id)->where('ticket_id', $ticket->id)->exists()) {
            return back()->with('error', 'Respons survei untuk tiket ini sudah tercatat.');
        }

        SurveyResponse::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'ticket_id' => $ticket->id,
            'satisfaction_score' => $request->satisfaction_score,
            'respondent_category' => auth()->check() ? (auth()->user()->activeRole?->name ?? 'Pengunjung') : 'Pengunjung Umum',
            'feedback_text' => $request->feedback_text,
            'would_recommend' => $request->boolean('would_recommend', true),
        ]);

        return back()->with('success', 'Terima kasih atas penilaian Anda dalam survei kepuasan pengunjung FUTURiSE 2026!');
    }
}
