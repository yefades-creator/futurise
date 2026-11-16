<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Project;
use App\Models\JudgeAssignment;
use App\Models\Assessment;
use App\Models\Score;
use App\Models\Criterion;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Exception;

class JudgingService
{
    /**
     * Submit or Update Assessment (Draft or Lock)
     * Enforces:
     * - Acceptance 08: Juri hanya dapat menilai karya yang ditugaskan & tidak dapat mengubah nilai setelah dikunci.
     * - Section 13 Formula: skor indikator = skor / 5 x bobot. Nilai maks 100 per juri.
     */
    public function saveAssessment(int $judgeUserId, int $projectId, array $scores, ?string $feedback = null, bool $lock = false): Assessment
    {
        return DB::transaction(function () use ($judgeUserId, $projectId, $scores, $feedback, $lock) {
            // Check assignment (Acceptance 08)
            $assignment = JudgeAssignment::where('user_id', $judgeUserId)
                ->where('project_id', $projectId)
                ->where('is_active', true)
                ->first();

            if (!$assignment) {
                throw new Exception("Akses ditolak: Anda tidak ditugaskan untuk menilai karya ini.");
            }

            $rubric = \App\Models\RubricVersion::where('event_id', $assignment->event_id)
                ->where('is_active', true)
                ->with('criteria')
                ->first();
            if (!$rubric || $rubric->criteria->isEmpty()) {
                throw new Exception('Rubrik penilaian aktif belum tersedia.');
            }
            $requiredCriterionIds = $rubric->criteria->pluck('id')->map(fn ($id) => (string) $id)->all();
            $submittedCriterionIds = array_map('strval', array_keys($scores));
            sort($requiredCriterionIds);
            sort($submittedCriterionIds);
            if ($submittedCriterionIds !== $requiredCriterionIds) {
                throw new Exception('Penilaian harus mengisi semua indikator pada rubrik aktif.');
            }

            // Find or create assessment
            $assessment = Assessment::firstOrNew([
                'judge_assignment_id' => $assignment->id,
                'user_id' => $judgeUserId,
                'project_id' => $projectId,
            ]);

            // Check if already locked (Acceptance 08)
            if ($assessment->exists && $assessment->status === 'locked') {
                throw new Exception("Nilai karya ini sudah dikunci dan tidak dapat diubah lagi.");
            }

            $assessment->general_feedback = $feedback;
            if ($lock) {
                $assessment->status = 'locked';
                $assessment->locked_at = now();
            }
            $assessment->save();

            // Save individual scores & calculate weighted total (Section 13)
            $totalScore = 0;
            foreach ($scores as $criterionId => $val) {
                $crit = $rubric->criteria->firstWhere('id', (int) $criterionId);
                if (!$crit || !is_numeric($val) || (int) $val < 1 || (int) $val > 5) {
                    throw new Exception('Skor indikator harus berupa angka 1 sampai 5 dari rubrik aktif.');
                }
                $val = (int) $val;
                // Formula: score / 5 * weight
                $weighted = ($val / 5.0) * (float)$crit->weight_percent;
                $totalScore += $weighted;

                Score::updateOrCreate(
                    [
                        'assessment_id' => $assessment->id,
                        'criterion_id' => $criterionId,
                    ],
                    [
                        'score_value' => $val,
                        'weighted_score' => $weighted,
                    ]
                );
            }

            $assessment->update(['final_score' => $totalScore]);

            if ($lock) {
                AuditLog::log(
                    'score_locked',
                    'Assessment',
                    $assessment->id,
                    null,
                    ['final_score' => $totalScore, 'project_id' => $projectId],
                    "Juri ID {$judgeUserId} mengunci nilai karya ID {$projectId} sebesar {$totalScore}",
                    $assignment->event_id
                );
            }

            return $assessment;
        });
    }

    /**
     * Unlock assessment with required reason and audit log
     */
    public function unlockAssessment(int $assessmentId, string $reason, int $unlockedBy): Assessment
    {
        return DB::transaction(function () use ($assessmentId, $reason, $unlockedBy) {
            $assessment = Assessment::lockForUpdate()->findOrFail($assessmentId);
            if ($assessment->status !== 'locked') {
                throw new Exception('Hanya nilai yang sudah terkunci yang dapat dibuka kembali.');
            }
            if (!filled(trim($reason))) {
                throw new Exception('Alasan pembukaan kunci wajib diisi.');
            }
            $old = ['status' => $assessment->status, 'final_score' => $assessment->final_score];

            $assessment->update([
                'status' => 'draft',
                'unlocked_by' => $unlockedBy,
                'unlock_reason' => $reason,
                'locked_at' => null,
            ]);

            AuditLog::log(
                'score_unlocked',
                'Assessment',
                $assessment->id,
                $old,
                ['status' => 'draft', 'unlock_reason' => $reason],
                "Pembukaan kunci nilai karya ID {$assessment->project_id} dengan alasan: {$reason}",
                $assessment->judgeAssignment->event_id
            );

            return $assessment;
        });
    }

    /**
     * Get Leaderboard of Projects
     * Enforces:
     * - BR-14: Nilai juri dan People's Choice dihitung terpisah.
     * - BR-15: Hasil tidak terbit ke publik sebelum disetujui.
     */
    public function getLeaderboard(int $eventId, bool $isPublicView = false): array
    {
        $event = Event::findOrFail($eventId);

        if ($isPublicView && !$event->is_results_published) {
            return [
                'is_published' => false,
                'message' => 'Hasil penilaian resmi dewan juri belum dipublikasikan oleh panitia.',
                'jury_rankings' => [],
                'peoples_choice' => [],
            ];
        }

        // Jury Rankings (avg locked score)
        $juryRankings = Project::where('event_id', $eventId)
            ->with(['organization', 'team'])
            ->withAvg(['assessments' => function($q) {
                $q->where('status', 'locked');
            }], 'final_score')
            ->withCount(['assessments' => function($q) {
                $q->where('status', 'locked');
            }])
            ->having('assessments_avg_final_score', '>', 0)
            ->orderByDesc('assessments_avg_final_score')
            ->get();

        // People's Choice (BR-14: calculated separately)
        $peoplesChoice = Project::where('event_id', $eventId)
            ->with(['organization', 'team'])
            ->withCount('votes')
            ->orderByDesc('votes_count')
            ->take(10)
            ->get();

        return [
            'is_published' => $event->is_results_published,
            'jury_rankings' => $juryRankings,
            'peoples_choice' => $peoplesChoice,
        ];
    }
}
