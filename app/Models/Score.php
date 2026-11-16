<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'assessment_id',
        'criterion_id',
        'score_value',
        'weighted_score',
        'notes',
    ];

    protected $casts = [
        'weighted_score' => 'decimal:2',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function criterion()
    {
        return $this->belongsTo(Criterion::class);
    }
}
