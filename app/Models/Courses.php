<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $fillable = [
        'semester_id',
        'code',
        'title',
        'credits',
        'marks',
        'grade',
        'grade_point',
        'status'
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
}