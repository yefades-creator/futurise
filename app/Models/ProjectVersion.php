<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectVersion extends Model
{
    protected $fillable = [
        'project_id',
        'version_number',
        'snapshot_data',
        'revision_notes',
        'submitted_by',
    ];

    protected $casts = [
        'snapshot_data' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }
}
