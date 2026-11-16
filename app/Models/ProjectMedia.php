<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMedia extends Model
{
    protected $table = 'project_media';

    protected $fillable = [
        'project_id',
        'file_path',
        'type',
        'title',
        'is_primary',
        'is_public',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
