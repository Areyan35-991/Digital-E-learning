<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id',
        'name',
        'department',
        'batch',
        'program',
        'email',
        'phone',
        'avatar'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function summary()
    {
        return $this->hasOne(StudentSummary::class, 'student_id', 'id');
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class, 'student_id', 'id')
            ->orderBy('start_date', 'asc');
    }
}