<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationApproval extends Model
{
    protected $fillable = [
        'project_id',
        'approved_by',
        'status',
        'remarks',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
