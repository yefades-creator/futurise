<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\CheckInLog;
use App\Models\User;
use App\Models\AuditLog;
use App\Models\SchoolVisit;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckInService
{
    public function checkInSchoolGroup(string $qrToken, int $actualAttendees, ?int $scannedBy = null): SchoolVisit
    {
        return DB::transaction(function () use ($qrToken, $actualAttendees, $scannedBy) {
            $visit = SchoolVisit::where('qr_group_token', trim($qrToken))->lockForUpdate()->firstOrFail();
            $slot = $visit->tourSlot()->lockForUpdate()->firstOrFail();
            $activeEvent = Event::active();
            if (!$activeEvent || (int) $slot->event_id !== (int) $activeEvent->id) {
                throw new Exception('QR rombongan ini berasal dari edisi acara yang tidak aktif.');
            }
            if ($visit->arrival_status !== 'confirmed') {
                throw new Exception('QR rombongan hanya dapat dipakai satu kali setelah pemesanan dikonfirmasi.');
            }
            $registeredCount = $visit->student_count + $visit->teacher_count;
            if ($actualAttendees > $registeredCount) {
                throw new Exception("Jumlah hadir tidak boleh melebihi jumlah rombongan terdaftar ({$registeredCount}).");
            }

            $old = ['arrival_status' => $visit->arrival_status, 'actual_attendees' => $visit->actual_attendees];
            $visit->update([
                'arrival_status' => 'arrived',
                'arrived_at' => now(),
                'actual_attendees' => $actualAttendees,
            ]);
            AuditLog::log(
                'school_group_checked_in',
                'SchoolVisit',
                $visit->id,
                $old,
                ['arrival_status' => 'arrived', 'actual_attendees' => $actualAttendees],
                "Check-in rombongan sekolah dengan jumlah aktual {$actualAttendees}",
                $slot->event_id
            );

            return $visit->fresh(['school', 'tourSlot']);
        });
    }

    /**
     * Process QR code check-in or check-out
     * Enforces:
     * - BR-11 & Acceptance 06: Repeated scan does not increase unique visitor count.
     * - BR-10: 1 identity per person per event.
     * - BR-12: Tracks in/out for concurrent occupancy calculation.
     */
    public function scanQrToken(string $qrToken, string $scanType = 'in', string $gate = 'Gate 1', ?int $scannedBy = null, bool $isManual = false, ?string $reason = null): array
    {
        if ($isManual && !filled($reason)) {
            throw new Exception('Alasan wajib diisi untuk prosedur override manual.');
        }
        return DB::transaction(function () use ($qrToken, $scanType, $gate, $scannedBy, $isManual, $reason) {
            $event = Event::active();
            if (!$event) throw new Exception('Acara aktif belum dikonfigurasi.');
            $ticket = Ticket::where('event_id', $event->id)->where('qr_token', trim($qrToken))->lockForUpdate()->first();

            if (!$ticket) {
                throw new Exception("QR Token tidak valid atau tidak terdaftar di sistem.");
            }
            if ($ticket->status === 'cancelled') {
                throw new Exception('Tiket ini sudah dibatalkan dan tidak dapat digunakan.');
            }

            $user = $ticket->user;
            $eventId = $ticket->event_id;

            $lastScan = CheckInLog::where('event_id', $eventId)
                ->where('user_id', $user->id)
                ->latest('id')
                ->value('scan_type');
            if ($scanType === 'out' && $lastScan !== 'in') {
                throw new Exception('Check-out ditolak karena tidak ada check-in aktif untuk tiket ini.');
            }

            // Check if this person (user_id) has already checked in anywhere in this event (BR-10 & BR-11)
            $hasCheckedInEver = CheckInLog::where('event_id', $eventId)
                ->where('user_id', $user->id)
                ->where('scan_type', 'in')
                ->exists();

            $isUniqueFirstEntry = false;

            if ($scanType === 'in') {
                if (!$hasCheckedInEver) {
                    $isUniqueFirstEntry = true;
                    $ticket->update([
                        'has_checked_in' => true,
                        'first_checked_in_at' => now(),
                        'status' => 'checked_in',
                    ]);
                }
            }

            // Create CheckInLog
            $log = CheckInLog::create([
                'event_id' => $eventId,
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
                'scan_type' => $scanType,
                'is_unique_first_entry' => $isUniqueFirstEntry,
                'gate_location' => $gate,
                'scanned_by' => $scannedBy ?? auth()->id(),
                'scanned_at' => now(),
                'is_manual_override' => $isManual,
                'override_reason' => $reason,
            ]);

            return [
                'status' => 'success',
                'ticket' => $ticket,
                'user' => $user,
                'scan_type' => $scanType,
                'is_unique_first_entry' => $isUniqueFirstEntry,
                'repeated_scan' => ($scanType === 'in' && !$isUniqueFirstEntry),
                'gate' => $gate,
                'scanned_at' => $log->scanned_at->format('d M Y H:i:s'),
                'message' => $isUniqueFirstEntry 
                    ? "Check-in pertama berhasil! Selamat datang, {$user->name}."
                    : ($scanType === 'in' 
                        ? "Scan ulang terdeteksi. Pengunjung ({$user->name}) sudah terdaftar sebelumnya (tidak menambah hitungan unik)."
                        : "Check-out berhasil untuk {$user->name}."),
            ];
        });
    }

    /**
     * Get real-time attendance stats:
     * - Total Registrations
     * - Cumulative Unique Visitors (BR-11)
     * - Current Concurrent Venue Occupancy (BR-12: Total In - Total Out)
     * - Venue Capacity
     */
    public function getAttendanceMetrics(int $eventId): array
    {
        $event = Event::with('venue')->findOrFail($eventId);
        $totalTickets = Ticket::where('event_id', $eventId)->count();
        
        // Unique visitors = distinct user_id with scan_type = 'in' (BR-11)
        $uniqueVisitors = CheckInLog::where('event_id', $eventId)
            ->where('scan_type', 'in')
            ->distinct('user_id')
            ->count('user_id');

        // Total In vs Out scans
        $totalInScans = CheckInLog::where('event_id', $eventId)->where('scan_type', 'in')->count();
        $totalOutScans = CheckInLog::where('event_id', $eventId)->where('scan_type', 'out')->count();
        
        // Concurrent occupancy (BR-12)
        $latestScanIds = CheckInLog::selectRaw('MAX(id)')
            ->where('event_id', $eventId)
            ->groupBy('user_id');
        $concurrentOccupancy = CheckInLog::whereIn('id', $latestScanIds)
            ->where('scan_type', 'in')
            ->distinct('user_id')
            ->count('user_id');
        $concurrentCapacity = $event->venue->concurrent_capacity ?? 600;
        $occupancyPercent = $concurrentCapacity > 0 ? round(($concurrentOccupancy / $concurrentCapacity) * 100, 1) : 0;

        return [
            'total_registered' => $totalTickets,
            'unique_visitors_cumulative' => $uniqueVisitors,
            'target_visitors' => $event->target_visitors,
            'cumulative_progress_percent' => round(($uniqueVisitors / max(1, $event->target_visitors)) * 100, 1),
            'total_in_scans' => $totalInScans,
            'total_out_scans' => $totalOutScans,
            'concurrent_occupancy' => $concurrentOccupancy,
            'concurrent_capacity' => $concurrentCapacity,
            'occupancy_percent' => $occupancyPercent,
            'is_over_capacity' => ($concurrentOccupancy > $concurrentCapacity),
        ];
    }
}
