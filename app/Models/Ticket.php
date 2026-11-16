<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'registration_id',
        'ticket_number',
        'qr_token',
        'category',
        'status',
        'has_checked_in',
        'first_checked_in_at',
    ];

    protected $casts = [
        'has_checked_in' => 'boolean',
        'first_checked_in_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($ticket) {
            if (empty($ticket->qr_token)) {
                $ticket->qr_token = Str::random(40);
            }
            if (empty($ticket->ticket_number)) {
                $ticket->ticket_number = 'FTR-' . strtoupper(Str::random(8));
            }
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function checkInLogs()
    {
        return $this->hasMany(CheckInLog::class);
    }

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }

    public function surveyResponse()
    {
        return $this->hasOne(SurveyResponse::class);
    }
}
