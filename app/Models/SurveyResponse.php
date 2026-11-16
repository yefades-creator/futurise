<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'ticket_id',
        'satisfaction_score',
        'respondent_category',
        'feedback_text',
        'would_recommend',
    ];

    protected $casts = [
        'would_recommend' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function isSatisfied(): bool
    {
        return $this->satisfaction_score >= 4;
    }
}
