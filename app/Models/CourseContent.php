<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    protected $fillable = [
        'course_id', 
        'instructor_id', 
        'title', 
        'description', 
        'content_type', 
        'file_path', 
        'order', 
        'is_published'
    ];

    public function course()
{
    return $this->belongsTo(Course::class);
}

public function attachments()
{
    return $this->hasMany(CourseAttachment::class);
}

public function progresses()
{
    return $this->hasMany(CourseProgress::class);
}
}