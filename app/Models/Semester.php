<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'student_id',
        'name',
        'year',
        'credits',
        'gpa',
        'start_date',
        'end_date',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'semester_id', 'id');
    }
}