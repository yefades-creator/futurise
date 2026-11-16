<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudgeAssignment extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'project_id',
        'has_conflict_of_interest',
        'conflict_declaration_notes',
        'is_active',
    ];

    protected $casts = [
        'has_conflict_of_interest' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function judge()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assessment()
    {
        return $this->hasOne(Assessment::class);
    }
}
