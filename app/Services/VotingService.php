<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Project;
use App\Models\Vote;
use App\Models\Ticket;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Exception;

class VotingService
{
    /**
     * Cast vote for People's Choice
     * Enforces:
     * - Section 14: Hak suara aktif setelah check-in
     * - Acceptance 07: Satu pengunjung tidak dapat memberikan suara kedua, termasuk request bersamaan
     */
    public function castVote(int $eventId, int $userId, int $projectId, ?string $ipAddress = null, ?string $userAgent = null): Vote
    {
        return DB::transaction(function () use ($eventId, $userId, $projectId, $ipAddress, $userAgent) {
            $event = Event::findOrFail($eventId);

            // Verify if voting period is open
            if ($event->voting_start_at && now()->lt($event->voting_start_at)) {
                throw new Exception("Periode voting belum dibuka.");
            }
            if ($event->voting_end_at && now()->gte($event->voting_end_at)) {
                throw new Exception("Periode voting telah ditutup.");
            }

            // Verify ticket and check-in status (Section 14)
            $ticket = Ticket::where('event_id', $eventId)
                ->where('user_id', $userId)
                ->where('status', 'checked_in')
                ->where('has_checked_in', true)
                ->first();

            if (!$ticket) {
                throw new Exception("Hak suara hanya aktif setelah Anda melakukan check-in resmi di lokasi festival (Sabuga).");
            }

            // Check if user already voted (Acceptance 07)
            $existingVote = Vote::where('event_id', $eventId)
                ->where('user_id', $userId)
                ->lockForUpdate()
                ->first();

            if ($existingVote) {
                throw new Exception("Anda sudah memberikan suara untuk karya '{$existingVote->project->title}'. Satu pengunjung hanya memiliki 1 hak suara.");
            }

            // Also check ticket_id uniqueness
            $ticketVoted = Vote::where('event_id', $eventId)
                ->where('ticket_id', $ticket->id)
                ->lockForUpdate()
                ->first();

            if ($ticketVoted) {
                throw new Exception("Tiket ini sudah pernah digunakan untuk voting.");
            }

            // Ensure project exists and is published
            $project = Project::where('event_id', $eventId)
                ->where('id', $projectId)
                ->published()
                ->firstOrFail();

            // Cast vote
            $vote = Vote::create([
                'event_id' => $eventId,
                'project_id' => $project->id,
                'user_id' => $userId,
                'ticket_id' => $ticket->id,
                'ip_address' => $ipAddress ?? request()->ip(),
                'user_agent' => $userAgent ?? request()->userAgent(),
            ]);

            return $vote;
        });
    }
}
