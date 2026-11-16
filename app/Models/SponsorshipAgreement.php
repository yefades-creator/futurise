<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorshipAgreement extends Model
{
    protected $fillable = [
        'event_id',
        'organization_id',
        'package_id',
        'agreement_number',
        'agreed_amount',
        'support_type',
        'in_kind_description',
        'status',
        'agreed_at',
        'contract_document',
    ];

    protected $casts = [
        'agreed_amount' => 'decimal:2',
        'agreed_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function package()
    {
        return $this->belongsTo(SponsorshipPackage::class, 'package_id');
    }

    public function fulfillments()
    {
        return $this->hasMany(BenefitFulfillment::class, 'agreement_id');
    }

    public function inKindContributions()
    {
        return $this->hasMany(InKindContribution::class, 'agreement_id');
    }
}
