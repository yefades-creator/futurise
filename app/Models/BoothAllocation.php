<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoothAllocation extends Model
{
    protected $fillable = [
        'event_id',
        'booth_id',
        'organization_id',
        'allocated_by',
        'status',
        'allocated_at',
        'notes',
    ];

    protected $casts = [
        'allocated_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function booth()
    {
        return $this->belongsTo(Booth::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function allocator()
    {
        return $this->belongsTo(User::class, 'allocated_by');
    }
}
