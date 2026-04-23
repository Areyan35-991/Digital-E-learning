<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'course_id',
        'student_id',
        'quiz_marks',
        'assignment_marks',
        'midterm_marks',
        'final_marks',
        'total_marks',
        'final_grade',
        'grade_point',
        'remarks',
        'teacher_id'
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Calculate total marks
    public function calculateTotalMarks()
    {
        // Adjust weights based on your grading system
        $total = ($this->quiz_marks * 0.15) + 
                ($this->assignment_marks * 0.25) + 
                ($this->midterm_marks * 0.25) + 
                ($this->final_marks * 0.35);
        
        $this->total_marks = round($total, 2);
        return $this->total_marks;
    }

    // Calculate grade based on marks
    public function calculateGrade()
    {
        $marks = $this->total_marks;
        
        if ($marks >= 80) return 'A+';
        if ($marks >= 75) return 'A';
        if ($marks >= 70) return 'A-';
        if ($marks >= 65) return 'B+';
        if ($marks >= 60) return 'B';
        if ($marks >= 55) return 'B-';
        if ($marks >= 50) return 'C+';
        if ($marks >= 45) return 'C';
        if ($marks >= 40) return 'D';
        return 'F';
    }

    // Calculate grade point
    public function calculateGradePoint()
    {
        $gradePoints = [
            'A+' => 4.00, 'A' => 3.75, 'A-'=> 3.50,
            'B+' => 3.25, 'B' => 3.00, 'B-' => 2.75,
            'C+' => 2.50, 'C' => 2.25, 'D' => 2.00,
            'F' => 0.0
        ];
        
        return $gradePoints[$this->final_grade] ?? 0.0;
    }
}