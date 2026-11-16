<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    protected $fillable = [
        'rubric_version_id',
        'code',
        'name',
        'description',
        'weight_percent',
        'max_scale',
        'sort_order',
    ];

    protected $casts = [
        'weight_percent' => 'decimal:2',
    ];

    public function rubricVersion()
    {
        return $this->belongsTo(RubricVersion::class);
    }
}
