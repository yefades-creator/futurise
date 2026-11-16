<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'edition',
        'theme',
        'start_date',
        'end_date',
        'venue_name',
        'venue_address',
        'city',
        'quota_campus',
        'quota_projects_per_campus',
        'quota_industry',
        'quota_partner',
        'target_pitching_finalists',
        'target_collaboration_meetings',
        'target_visitors',
        'target_h30_followups',
        'target_satisfaction_rate',
        'min_survey_responses',
        'registration_deadline',
        'voting_start_at',
        'voting_end_at',
        'is_date_confirmed',
        'is_results_published',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'registration_deadline' => 'datetime',
        'voting_start_at' => 'datetime',
        'voting_end_at' => 'datetime',
        'is_date_confirmed' => 'boolean',
        'is_results_published' => 'boolean',
        'is_active' => 'boolean',
    ];

    public static function active()
    {
        return static::where('is_active', true)->first() ?? static::first();
    }

    public function venue()
    {
        return $this->hasOne(Venue::class);
    }

    public function settings()
    {
        return $this->hasMany(EventSetting::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function booths()
    {
        return $this->hasMany(Booth::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function sessions()
    {
        return $this->hasMany(EventSession::class);
    }

    public function tourSlots()
    {
        return $this->hasMany(TourSlot::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function checkInLogs()
    {
        return $this->hasMany(CheckInLog::class);
    }

    public function surveyResponses()
    {
        return $this->hasMany(SurveyResponse::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function sponsorshipPackages()
    {
        return $this->hasMany(SponsorshipPackage::class);
    }

    public function sponsorshipAgreements()
    {
        return $this->hasMany(SponsorshipAgreement::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
