<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSummary extends Model
{
    protected $fillable = [
        'student_id',
        'cgpa',
        'total_credits',
        'total_courses',
        'total_semesters'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'student_id';

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}