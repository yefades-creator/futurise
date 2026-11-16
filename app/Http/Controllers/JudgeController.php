<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\JudgeAssignment;
use App\Models\Assessment;
use App\Models\Criterion;
use App\Models\RubricVersion;
use App\Models\Project;
use App\Services\JudgingService;
use Illuminate\Http\Request;
use Exception;

class JudgeController extends Controller
{
    protected function getActiveEvent()
    {
        return Event::where('is_active', true)->first() ?? Event::firstOrFail();
    }

    public function dashboard()
    {
        $user = auth()->user();
        $event = $this->getActiveEvent();

        // Acceptance 08: Juri hanya dapat melihat dan menilai karya yang ditugaskan
        $assignments = JudgeAssignment::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->where('is_active', true)
            ->with(['project.organization', 'project.team', 'assessment'])
            ->get();

        $completedCount = $assignments->filter(fn($a) => $a->assessment && $a->assessment->status === 'locked')->count();
        $pendingCount = $assignments->count() - $completedCount;

        return view('juri.dashboard', compact('user', 'event', 'assignments', 'completedCount', 'pendingCount'));
    }

    public function showAssessment($projectId)
    {
        $user = auth()->user();
        $event = $this->getActiveEvent();

        // Acceptance 08: Validate judge assignment
        $assignment = JudgeAssignment::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->where('project_id', $projectId)
            ->where('is_active', true)
            ->firstOrFail();

        $project = Project::with(['organization', 'team.members', 'booth', 'technicalRequirement'])->findOrFail($projectId);

        // Active Rubric (Section 13)
        $rubric = RubricVersion::where('event_id', $event->id)
            ->where('is_active', true)
            ->with('criteria')
            ->first();

        // Existing Assessment
        $assessment = Assessment::where('user_id', $user->id)
            ->where('project_id', $projectId)
            ->with('scores')
            ->first();

        $existingScores = $assessment ? $assessment->scores->pluck('score_value', 'criterion_id')->toArray() : [];

        return view('juri.assessment', compact('user', 'event', 'assignment', 'project', 'rubric', 'assessment', 'existingScores'));
    }

    public function storeAssessment(Request $request, $projectId, JudgingService $judgingService)
    {
        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:2000',
            'action' => 'required|in:draft,lock',
        ]);

        $lock = ($request->action === 'lock');

        try {
            $assessment = $judgingService->saveAssessment(
                auth()->id(),
                $projectId,
                $request->scores,
                $request->feedback,
                $lock
            );

            $msg = $lock 
                ? "Penilaian resmi berhasil difinalisasi dan DIKUNCI (Nilai Akhir: {$assessment->final_score}/100). Sesuai Acceptance 08, nilai terkunci tidak dapat diubah lagi."
                : "Draf penilaian berhasil disimpan sementara.";

            return redirect()->route('juri.dashboard')->with('success', $msg);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function declareConflict(Request $request, $assignmentId)
    {
        $assignment = JudgeAssignment::where('user_id', auth()->id())->findOrFail($assignmentId);

        $assignment->update([
            'has_conflict_of_interest' => true,
            'conflict_declaration_notes' => $request->input('notes', 'Deklarasi konflik kepentingan diajukan oleh juri.'),
            'is_active' => false, // deactivates assignment
        ]);

        return back()->with('success', 'Deklarasi konflik kepentingan telah dicatat. Penugasan untuk karya ini dinonaktifkan.');
    }
}
