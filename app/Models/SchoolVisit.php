<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolVisit extends Model
{
    protected $fillable = [
        'tour_slot_id',
        'organization_id',
        'student_count',
        'teacher_count',
        'pic_name',
        'pic_phone',
        'qr_group_token',
        'arrival_status',
        'arrived_at',
        'actual_attendees',
        'arrival_notes',
    ];

    protected $casts = [
        'arrived_at' => 'datetime',
    ];

    public function tourSlot()
    {
        return $this->belongsTo(TourSlot::class);
    }

    public function school()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
