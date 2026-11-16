<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'event_id',
        'title',
        'division',
        'assigned_to',
        'due_date',
        'status',
        'priority',
        'description',
        'proof_file',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
