<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'address',
        'map_embed_url',
        'floor_plan_image',
        'concurrent_capacity',
        'facilities',
        'transport_guide',
    ];

    protected $casts = [
        'facilities' => 'array',
        'concurrent_capacity' => 'integer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
