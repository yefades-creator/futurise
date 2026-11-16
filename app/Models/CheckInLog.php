<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInLog extends Model
{
    protected $fillable = [
        'event_id',
        'ticket_id',
        'user_id',
        'scan_type',
        'is_unique_first_entry',
        'gate_location',
        'scanned_by',
        'scanned_at',
        'is_manual_override',
        'override_reason',
    ];

    protected $casts = [
        'is_unique_first_entry' => 'boolean',
        'is_manual_override' => 'boolean',
        'scanned_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scanner()
    {
        return $this->belongsTo(User::class, 'scanned_by');
    }
}
