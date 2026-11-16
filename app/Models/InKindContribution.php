<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InKindContribution extends Model
{
    protected $fillable = [
        'agreement_id',
        'organization_id',
        'item_name',
        'estimated_value',
        'quantity',
        'unit',
        'description',
        'delivery_status',
        'received_at',
        'receiver_name',
    ];

    protected $casts = [
        'estimated_value' => 'decimal:2',
        'received_at' => 'datetime',
    ];

    public function agreement()
    {
        return $this->belongsTo(SponsorshipAgreement::class, 'agreement_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
