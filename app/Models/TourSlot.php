<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourSlot extends Model
{
    protected $fillable = [
        'event_id',
        'slot_name',
        'date',
        'start_time',
        'end_time',
        'max_capacity',
        'booked_count',
        'guide_name',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function visits()
    {
        return $this->hasMany(SchoolVisit::class);
    }
}
