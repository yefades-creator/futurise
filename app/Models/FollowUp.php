<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $fillable = [
        'event_id',
        'meeting_id',
        'project_id',
        'organization_id',
        'pic_user_id',
        'title',
        'action_plan',
        'deadline_h30',
        'status',
        'result_summary',
        'h30_notes',
        'completed_at',
    ];

    protected $casts = [
        'deadline_h30' => 'date',
        'completed_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function pic()
    {
        return $this->belongsTo(User::class, 'pic_user_id');
    }

    public function isOverdue(): bool
    {
        return $this->status !== 'completed' && $this->deadline_h30->isPast();
    }
}
