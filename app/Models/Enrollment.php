<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id', 
        'course_id', 
        'enrolled_at', 
        'last_accessed_at', 
        'is_active', 
        'progress'
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'is_active' => 'boolean',
        'progress' => 'decimal:2'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}