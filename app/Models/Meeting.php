<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'event_id',
        'requester_org_id',
        'target_org_id',
        'project_id',
        'table_number',
        'start_time',
        'end_time',
        'agenda_topic',
        'status',
        'discussion_notes',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function requester()
    {
        return $this->belongsTo(Organization::class, 'requester_org_id');
    }

    public function target()
    {
        return $this->belongsTo(Organization::class, 'target_org_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function participants()
    {
        return $this->hasMany(MeetingParticipant::class);
    }

    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }

    // BR-13: Clash check for parties and tables
    public static function hasConflict(int $eventId, string $tableNumber, int $partyAId, int $partyBId, string $startTime, string $endTime, ?int $excludeMeetingId = null): ?string
    {
        // Check table conflict
        $tableConflict = static::where('event_id', $eventId)
            ->where('table_number', $tableNumber)
            ->whereIn('status', ['requested', 'confirmed'])
            ->when($excludeMeetingId, fn($q) => $q->where('id', '!=', $excludeMeetingId))
            ->where(function($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime])
                  ->orWhere(function($sub) use ($startTime, $endTime) {
                      $sub->where('start_time', '<=', $startTime)
                          ->where('end_time', '>=', $endTime);
                  });
            })->first();

        if ($tableConflict) {
            return "Meja {$tableNumber} sudah terpakai pada rentang waktu tersebut.";
        }

        // Check party conflict
        $partyConflict = static::where('event_id', $eventId)
            ->where(function($q) use ($partyAId, $partyBId) {
                $q->whereIn('requester_org_id', [$partyAId, $partyBId])
                  ->orWhereIn('target_org_id', [$partyAId, $partyBId]);
            })
            ->whereIn('status', ['requested', 'confirmed'])
            ->when($excludeMeetingId, fn($q) => $q->where('id', '!=', $excludeMeetingId))
            ->where(function($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime])
                  ->orWhere(function($sub) use ($startTime, $endTime) {
                      $sub->where('start_time', '<=', $startTime)
                          ->where('end_time', '>=', $endTime);
                  });
            })->first();

        if ($partyConflict) {
            return "Salah satu organisasi pihak terkait sudah memiliki jadwal pertemuan lain pada rentang waktu tersebut.";
        }

        return null;
    }
}
