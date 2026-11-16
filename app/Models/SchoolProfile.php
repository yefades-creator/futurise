<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'organization_id',
        'school_type',
        'principal_name',
        'total_students_group',
        'total_teachers_group',
        'visit_purpose',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
