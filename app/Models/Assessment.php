<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'judge_assignment_id',
        'user_id',
        'project_id',
        'status',
        'final_score',
        'general_feedback',
        'locked_at',
        'unlocked_by',
        'unlock_reason',
    ];

    protected $casts = [
        'final_score' => 'decimal:2',
        'locked_at' => 'datetime',
    ];

    public function judgeAssignment()
    {
        return $this->belongsTo(JudgeAssignment::class);
    }

    public function judge()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function calculateFinalScore(): float
    {
        $total = 0;
        foreach ($this->scores()->with('criterion')->get() as $score) {
            $weight = $score->criterion->weight_percent ?? 0;
            // score 1..5 -> score / 5 * weight
            $weighted = ($score->score_value / 5.0) * $weight;
            $score->update(['weighted_score' => $weighted]);
            $total += $weighted;
        }

        $this->update(['final_score' => $total]);
        return round($total, 2);
    }
}
