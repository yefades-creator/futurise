<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSetting extends Model
{
    protected $fillable = [
        'event_id',
        'key',
        'value',
        'type',
        'group',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
