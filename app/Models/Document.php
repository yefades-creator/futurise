<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'event_id',
        'title',
        'category',
        'file_path',
        'file_size_kb',
        'is_public',
        'download_count',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
