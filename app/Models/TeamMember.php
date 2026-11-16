<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'team_id',
        'user_id',
        'name',
        'nim_nisn',
        'study_program',
        'student_status',
        'is_leader',
        'email',
        'phone',
    ];

    protected $casts = [
        'is_leader' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
