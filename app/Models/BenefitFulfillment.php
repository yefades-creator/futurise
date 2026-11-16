<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BenefitFulfillment extends Model
{
    protected $fillable = [
        'agreement_id',
        'benefit_id',
        'status',
        'proof_file',
        'proof_url',
        'verified_by',
        'verified_at',
        'notes',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function agreement()
    {
        return $this->belongsTo(SponsorshipAgreement::class, 'agreement_id');
    }

    public function benefit()
    {
        return $this->belongsTo(Benefit::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
