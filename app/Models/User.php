<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified',
        'email_domain',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'email_verified' => 'boolean',
        ];
    }

    // Relationship with courses (for teachers)
     public function teachingCourses()
{
    return $this->belongsToMany(Course::class, 'course_teacher', 'instructor_id', 'course_id')
                ->withPivot('is_active')
                ->withTimestamps();
}

    public function courseContents()
    {
        return $this->hasMany(CourseContent::class, 'instructor_id');
    }

    public function isTeacher()
    {
        return $this->role === 'teacher'; // or whatever logic you use
    }


    // Check if email is educational
    public static function isEducationalEmail($email)
    {
        $educationalDomains = [
            'diu.edu.bd',
            
        ];

        $domain = substr(strrchr($email, "@"), 1);
        
        foreach ($educationalDomains as $eduDomain) {
            if (str_ends_with($domain, $eduDomain)) {
                return true;
            }
        }
        
        return false;
    }
   public function enrollments()
{
    return $this->hasMany(Enrollment::class, 'student_id');
}


public function enrolledCourses()
{
     return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id')
                ->withPivot('status', 'progress', 'enrolled_at')
                ->withTimestamps();
}

public function progress()
{
    return $this->hasMany(StudentProgress::class, 'student_id');
}

public function isStudent()
{
    return $this->role === 'student';
}

// In Course.php model
public function modules()
{
    return $this->hasMany(Module::class)->orderBy('order');
}

public function lessons()
{
    return $this->hasManyThrough(Lesson::class, Module::class);
}

    
}