<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalRequirement extends Model
{
    protected $fillable = [
        'project_id',
        'organization_id',
        'device_list',
        'device_count',
        'power_watt',
        'internet_type',
        'demo_area_type',
        'special_requests',
        'status',
        'verifier_notes',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
