<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'organization_id',
        'sector',
        'profile_summary',
        'solutions_offered',
        'collaboration_needs',
        'is_exhibitor',
        'is_sponsor',
    ];

    protected $casts = [
        'is_exhibitor' => 'boolean',
        'is_sponsor' => 'boolean',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
