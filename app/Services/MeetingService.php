<?php

namespace App\Services;

use App\Models\Meeting;
use App\Models\MeetingParticipant;
use App\Models\AuditLog;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Exception;

class MeetingService
{
    /**
     * Schedule a collaboration meeting
     * Enforces:
     * - BR-13 & Acceptance 10: Pertemuan dengan pihak atau meja bentrok ditolak.
     */
    public function scheduleMeeting(int $eventId, int $requesterOrgId, int $targetOrgId, string $tableNumber, string $startTime, string $endTime, string $topic, ?int $projectId = null, bool $confirmedByStaff = false): Meeting
    {
        return DB::transaction(function () use ($eventId, $requesterOrgId, $targetOrgId, $tableNumber, $startTime, $endTime, $topic, $projectId, $confirmedByStaff) {
            Event::whereKey($eventId)->lockForUpdate()->firstOrFail();
            Organization::where('event_id', $eventId)->whereKey($requesterOrgId)->firstOrFail();
            Organization::where('event_id', $eventId)->whereKey($targetOrgId)->firstOrFail();
            if ($projectId && !Project::where('event_id', $eventId)->where('organization_id', $requesterOrgId)->whereKey($projectId)->exists()) {
                throw new Exception('Karya pertemuan harus berasal dari organisasi pengaju pada acara ini.');
            }
            if ($requesterOrgId === $targetOrgId) {
                throw new Exception("Organisasi tidak dapat menjadwalkan pertemuan dengan dirinya sendiri.");
            }

            // Check clash (BR-13)
            $clashError = Meeting::hasConflict($eventId, $tableNumber, $requesterOrgId, $targetOrgId, $startTime, $endTime);
            if ($clashError) {
                throw new Exception("Penjadwalan Ditolak (BR-13 Bentrok): {$clashError}");
            }

            $meeting = Meeting::create([
                'event_id' => $eventId,
                'requester_org_id' => $requesterOrgId,
                'target_org_id' => $targetOrgId,
                'project_id' => $projectId,
                'table_number' => $tableNumber,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'agenda_topic' => $topic,
                'status' => $confirmedByStaff ? 'confirmed' : 'requested',
            ]);

            MeetingParticipant::create([
                'meeting_id' => $meeting->id,
                'organization_id' => $requesterOrgId,
                'role' => 'host',
                'status' => 'confirmed',
            ]);

            MeetingParticipant::create([
                'meeting_id' => $meeting->id,
                'organization_id' => $targetOrgId,
                'role' => 'invitee',
                'status' => $confirmedByStaff ? 'confirmed' : 'invited',
            ]);

            return $meeting;
        });
    }

    public function updateMeetingStatus(int $meetingId, string $status, int $updatedBy): Meeting
    {
        return DB::transaction(function () use ($meetingId, $status, $updatedBy) {
            $meeting = Meeting::lockForUpdate()->findOrFail($meetingId);
            Event::whereKey($meeting->event_id)->lockForUpdate()->firstOrFail();
            if (!in_array($status, ['confirmed', 'cancelled'], true)) {
                throw new Exception('Status pertemuan tidak valid.');
            }

            if ($status === 'confirmed') {
                $conflict = Meeting::hasConflict(
                    $meeting->event_id,
                    $meeting->table_number,
                    $meeting->requester_org_id,
                    $meeting->target_org_id,
                    $meeting->start_time->toDateTimeString(),
                    $meeting->end_time->toDateTimeString(),
                    $meeting->id
                );
                if ($conflict) throw new Exception("Konfirmasi ditolak (BR-13): {$conflict}");
            }

            $oldStatus = $meeting->status;
            $meeting->update(['status' => $status]);
            $meeting->participants()->update(['status' => $status === 'confirmed' ? 'confirmed' : 'declined']);
            AuditLog::log(
                'meeting_status_changed',
                'Meeting',
                $meeting->id,
                ['status' => $oldStatus],
                ['status' => $status],
                "Status pertemuan {$meeting->id} diperbarui menjadi {$status}",
                $meeting->event_id
            );

            return $meeting;
        });
    }
}
