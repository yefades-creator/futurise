<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SupportTicket extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_code',
        'category',
        'subject',
        'message',
        'status',
        'priority',
        'response_text',
        'responded_by',
        'responded_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($st) {
            if (empty($st->ticket_code)) {
                $st->ticket_code = 'HLP-' . strtoupper(Str::random(6));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responder()
    {
        return $this->belongsTo(User::class, 'responded_by');
    }
}
