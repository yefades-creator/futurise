<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampusProfile extends Model
{
    protected $fillable = [
        'organization_id',
        'rector_name',
        'campus_type',
        'accreditation',
        'student_count',
        'faculty_name',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
