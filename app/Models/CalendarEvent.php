<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    protected $fillable = [
        'course_id',
        'teacher_id',
        'title',
        'description',
        'event_date',
        'event_time',
        'event_type',
        'is_all_day'
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
        'is_all_day' => 'boolean'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}