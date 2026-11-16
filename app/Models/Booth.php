<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    protected $fillable = [
        'event_id',
        'code',
        'category',
        'size',
        'power_watt',
        'max_projects',
        'zone',
        'location_description',
        'x_coord',
        'y_coord',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function allocation()
    {
        return $this->hasOne(BoothAllocation::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function isAllocated(): bool
    {
        return $this->allocation()->whereIn('status', ['allocated', 'confirmed', 'active'])->exists();
    }
}
