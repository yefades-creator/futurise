<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = [
        'session_id',
        'name',
        'title',
        'organization',
        'photo',
        'bio',
    ];

    public function session()
    {
        return $this->belongsTo(EventSession::class, 'session_id');
    }
}
