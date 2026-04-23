<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    protected $fillable = [
        'student_id',
        'course_id', 
        'content_id',
        'is_completed',
        'completed_at',
        'time_spent'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
        'time_spent' => 'integer'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function content()
    {
        return $this->belongsTo(CourseContent::class, 'content_id');
    }
}