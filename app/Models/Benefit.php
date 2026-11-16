<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $fillable = [
        'package_id',
        'name',
        'description',
        'required_proof_type',
    ];

    public function package()
    {
        return $this->belongsTo(SponsorshipPackage::class, 'package_id');
    }
}
