<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'identity_number',
        'organization_name',
        'position',
        'bio',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
