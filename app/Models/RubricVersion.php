<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RubricVersion extends Model
{
    protected $fillable = [
        'event_id',
        'version_name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function criteria()
    {
        return $this->hasMany(Criterion::class)->orderBy('sort_order');
    }
}
