<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    protected $fillable = [
        'event_id',
        'title',
        'slug',
        'type',
        'stage_or_room',
        'start_time',
        'end_time',
        'description',
        'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function speakers()
    {
        return $this->hasMany(Speaker::class, 'session_id');
    }
}
