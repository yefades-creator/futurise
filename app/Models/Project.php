<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'event_id',
        'organization_id',
        'team_id',
        'booth_id',
        'title',
        'slug',
        'category',
        'problem_statement',
        'target_users',
        'solution_description',
        'key_features',
        'technology_stack',
        'readiness_level',
        'test_results',
        'limitations',
        'demo_url',
        'video_url',
        'poster_image',
        'thumbnail',
        'collaboration_needs',
        'is_published_consent',
        'status',
        'is_locked',
        'curator_notes',
        'reviewed_by',
        'reviewed_at',
        'publication_status',
        'is_pitch_finalist',
        'pitch_order',
        'view_count',
    ];

    protected $casts = [
        'is_published_consent' => 'boolean',
        'is_locked' => 'boolean',
        'is_pitch_finalist' => 'boolean',
        'reviewed_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function booth()
    {
        return $this->belongsTo(Booth::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function versions()
    {
        return $this->hasMany(ProjectVersion::class);
    }

    public function media()
    {
        return $this->hasMany(ProjectMedia::class);
    }

    public function technicalRequirement()
    {
        return $this->hasOne(TechnicalRequirement::class);
    }

    public function publicationApproval()
    {
        return $this->hasOne(PublicationApproval::class);
    }

    public function judgeAssignments()
    {
        return $this->hasMany(JudgeAssignment::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(ProjectFeedback::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        // Enforces BR-11 Acceptance & Section 6
        return $query->where('publication_status', 'terbit')
                     ->where('is_published_consent', true);
    }

    public function scopePitchFinalists($query)
    {
        return $query->where('is_pitch_finalist', true)->orderBy('pitch_order');
    }

    public function averageScore(): float
    {
        $avg = $this->assessments()->where('status', 'locked')->avg('final_score');
        return $avg ? round($avg, 2) : 0.00;
    }
}
