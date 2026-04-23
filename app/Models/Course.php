<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
protected $fillable = [
    'title',
    'slug', 
    'description',
    'instructor',
    'instructor_id',
    'enrollment_key',
    'category',
    'semester',
    'language',
    'skill_level',
    'lessons',
    'duration_weeks',
    'enrolled_count',
    'image',
    'is_published'
    
];

    protected $casts = [
        'price' => 'decimal:2',
        'is_free' => 'boolean',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'guest_access' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'last_updated' => 'datetime',
    ];

    // Relationships
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(User::class, 'instructors', 'course_id', 'instructor_id')
                    ->withPivot('is_primary')
                    ->withTimestamps();
    }
      public function contents()
    {
        return $this->hasMany(CourseContent::class);
    }

    public function teacherContents($teacherId)
{
    return $this->contents()->where('instructor_id', $teacherId);
}

  //  public function sections()
   // {
  //      return $this->hasMany(Course::class);
  //  } 
public function enrollments()
{
    return $this->hasMany(Enrollment::class);
}

public function enrolledStudents()
{
    return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id')
                ->where('role', 'student')
                ->withPivot('status', 'progress', 'enrolled_at')
                ->withTimestamps();
}

public function students()
{
    return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id')
                ->withPivot('progress', 'last_accessed_at')
                ->withTimestamps();
}

public function calendarEvents()
{
    return $this->hasMany(CalendarEvent::class);
}
    public function primaryInstructor()
    {
        return $this->instructors()->wherePivot('is_primary', true)->first();
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    public function scopeBySemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }

    // Helpers
   
    public function canGuestAccess()
    {
        return $this->guest_access;
    }

    public function isSelfEnrollment()
    {
        return $this->enrollment_type === 'self_enrollment';
    }

    public function getDurationTextAttribute()
    {
        return $this->duration_weeks . ' weeks';
    }

    public function getLastUpdatedTextAttribute()
    {
        return $this->last_updated ? $this->last_updated->format('d M Y') : 'Never';
    }
      // Relationship with assigned teacher (if using instructor_id)
    public function assignedTeacher()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // Get the instructor name - handles both string and relationship
    public function getInstructorNameAttribute()
    {
        if ($this->assignedTeacher) {
            return $this->assignedTeacher->name;
        }
        
        return $this->instructor; // Fall back to string field
    }
}

