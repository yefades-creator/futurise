<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'event_id',
        'type',
        'name',
        'slug',
        'address',
        'city',
        'website',
        'logo',
        'pic_name',
        'pic_position',
        'pic_email',
        'pic_phone',
        'pic_contact_public',
        'status',
        'verification_notes',
    ];

    protected $casts = [
        'pic_contact_public' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function campusProfile()
    {
        return $this->hasOne(CampusProfile::class);
    }

    public function companyProfile()
    {
        return $this->hasOne(CompanyProfile::class);
    }

    public function schoolProfile()
    {
        return $this->hasOne(SchoolProfile::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'organization_memberships')
            ->wherePivot('is_active', true)
            ->withPivot('role_in_org', 'is_active')
            ->withTimestamps();
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function boothAllocations()
    {
        return $this->hasMany(BoothAllocation::class);
    }

    public function allocatedBooth()
    {
        return $this->hasOneThrough(Booth::class, BoothAllocation::class, 'organization_id', 'id', 'id', 'booth_id');
    }

    public function sponsorshipAgreement()
    {
        return $this->hasOne(SponsorshipAgreement::class)->latestOfMany();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function meetingsRequested()
    {
        return $this->hasMany(Meeting::class, 'requester_org_id');
    }

    public function meetingsTargeted()
    {
        return $this->hasMany(Meeting::class, 'target_org_id');
    }
}
