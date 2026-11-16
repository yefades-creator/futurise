<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaborationNeed extends Model
{
    protected $fillable = [
        'organization_id',
        'project_id',
        'title',
        'description',
        'target_partner_type',
        'scope_of_work',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
