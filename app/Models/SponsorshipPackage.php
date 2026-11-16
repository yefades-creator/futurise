<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorshipPackage extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'slug',
        'price',
        'quota',
        'benefits_summary',
        'includes_booth',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'includes_booth' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class, 'package_id');
    }

    public function agreements()
    {
        return $this->hasMany(SponsorshipAgreement::class, 'package_id');
    }
}
