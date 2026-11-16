<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFeedback extends Model
{
    protected $table = 'project_feedbacks';

    protected $fillable = [
        'project_id',
        'user_id',
        'giver_category',
        'giver_name',
        'giver_organization',
        'rating',
        'comment',
        'suggestion',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
