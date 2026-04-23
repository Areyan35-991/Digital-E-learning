<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseProgress extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_progress';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'course_id',
        'content_id',
        'status',
        'percentage',
        'duration',
        'started_at',
        'last_accessed_at',
        'completed_at',
        'notes',
        'metadata'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'percentage' => 'integer',
        'duration' => 'integer', // in seconds
        'started_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'completed_at' => 'datetime',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'started_at',
        'last_accessed_at',
        'completed_at',
        'deleted_at'
    ];

    /**
     * Status constants
     */
    const STATUS_NOT_STARTED = 'not_started';
    const STATUS_STARTED = 'started';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REVIEWED = 'reviewed';

    /**
     * Scope a query to only include progress for a specific student.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $studentId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    /**
     * Scope a query to only include progress for a specific course.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $courseId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    /**
     * Scope a query to only include completed progress.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope a query to only include in-progress content.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    /**
     * Scope a query to only include started content.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStarted($query)
    {
        return $query->where('status', self::STATUS_STARTED);
    }

    /**
     * Scope a query to only include not started content.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotStarted($query)
    {
        return $query->where('status', self::STATUS_NOT_STARTED);
    }

    /**
     * Scope a query to order by last accessed date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecentlyAccessed($query)
    {
        return $query->orderBy('last_accessed_at', 'desc');
    }

    /**
     * Get the student associated with the progress.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the course associated with the progress.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the content associated with the progress.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(CourseContent::class, 'content_id');
    }

    /**
     * Get the enrollment associated with this progress.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'student_id', 'student_id')
                    ->where('course_id', $this->course_id);
    }

    /**
     * Check if the content is completed.
     *
     * @return bool
     */
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED || $this->percentage >= 100;
    }

    /**
     * Check if the content is in progress.
     *
     * @return bool
     */
    public function isInProgress()
    {
        return $this->status === self::STATUS_IN_PROGRESS || 
               ($this->percentage > 0 && $this->percentage < 100);
    }

    /**
     * Check if the content is started.
     *
     * @return bool
     */
    public function isStarted()
    {
        return $this->status === self::STATUS_STARTED || $this->started_at !== null;
    }

    /**
     * Mark the content as started.
     *
     * @return $this
     */
    public function markAsStarted()
    {
        $this->update([
            'status' => self::STATUS_STARTED,
            'started_at' => now(),
            'last_accessed_at' => now(),
            'percentage' => 0
        ]);
        
        return $this;
    }

    /**
     * Update progress percentage.
     *
     * @param int $percentage
     * @param int|null $duration
     * @return $this
     */
    public function updateProgress($percentage, $duration = null)
    {
        $status = $percentage >= 100 ? self::STATUS_COMPLETED : self::STATUS_IN_PROGRESS;
        
        $updateData = [
            'status' => $status,
            'percentage' => min(100, max(0, $percentage)),
            'last_accessed_at' => now()
        ];
        
        if ($duration !== null) {
            $updateData['duration'] = $duration;
        }
        
        if ($percentage >= 100) {
            $updateData['completed_at'] = now();
        }
        
        $this->update($updateData);
        
        return $this;
    }

    /**
     * Mark the content as completed.
     *
     * @param int|null $duration
     * @return $this
     */
    public function markAsCompleted($duration = null)
    {
        return $this->updateProgress(100, $duration);
    }

    /**
     * Reset progress to not started.
     *
     * @return $this
     */
    public function resetProgress()
    {
        $this->update([
            'status' => self::STATUS_NOT_STARTED,
            'percentage' => 0,
            'duration' => 0,
            'started_at' => null,
            'completed_at' => null,
            'notes' => null
        ]);
        
        return $this;
    }

    /**
     * Get formatted duration.
     *
     * @return string
     */
    public function getFormattedDurationAttribute()
    {
        if (!$this->duration) {
            return '0s';
        }
        
        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;
        
        if ($hours > 0) {
            return sprintf('%dh %dm %ds', $hours, $minutes, $seconds);
        } elseif ($minutes > 0) {
            return sprintf('%dm %ds', $minutes, $seconds);
        } else {
            return sprintf('%ds', $seconds);
        }
    }

    /**
     * Get estimated time to complete.
     *
     * @return string|null
     */
    public function getEstimatedTimeToCompleteAttribute()
    {
        if ($this->isCompleted() || $this->percentage >= 100) {
            return null;
        }
        
        if ($this->duration && $this->percentage > 0) {
            $secondsPerPercent = $this->duration / $this->percentage;
            $remainingSeconds = $secondsPerPercent * (100 - $this->percentage);
            
            $hours = floor($remainingSeconds / 3600);
            $minutes = floor(($remainingSeconds % 3600) / 60);
            
            if ($hours > 0) {
                return sprintf('%d hour%s', $hours, $hours > 1 ? 's' : '');
            } elseif ($minutes > 0) {
                return sprintf('%d minute%s', $minutes, $minutes > 1 ? 's' : '');
            } else {
                return 'Less than a minute';
            }
        }
        
        return null;
    }

    /**
     * Get progress color based on percentage.
     *
     * @return string
     */
    public function getProgressColorAttribute()
    {
        if ($this->percentage >= 100) {
            return 'green';
        } elseif ($this->percentage >= 70) {
            return 'blue';
        } elseif ($this->percentage >= 40) {
            return 'yellow';
        } else {
            return 'red';
        }
    }

    /**
     * Get progress icon based on status.
     *
     * @return string
     */
    public function getProgressIconAttribute()
    {
        if ($this->isCompleted()) {
            return 'fas fa-check-circle';
        } elseif ($this->isInProgress()) {
            return 'fas fa-spinner';
        } elseif ($this->isStarted()) {
            return 'fas fa-play-circle';
        } else {
            return 'far fa-circle';
        }
    }

    /**
     * Get progress badge class based on status.
     *
     * @return string
     */
    public function getProgressBadgeClassAttribute()
    {
        if ($this->isCompleted()) {
            return 'bg-green-100 text-green-800';
        } elseif ($this->isInProgress()) {
            return 'bg-blue-100 text-blue-800';
        } elseif ($this->isStarted()) {
            return 'bg-yellow-100 text-yellow-800';
        } else {
            return 'bg-gray-100 text-gray-800';
        }
    }

    /**
     * Get readable status.
     *
     * @return string
     */
    public function getReadableStatusAttribute()
    {
        $statusMap = [
            self::STATUS_NOT_STARTED => 'Not Started',
            self::STATUS_STARTED => 'Started',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_REVIEWED => 'Reviewed'
        ];
        
        return $statusMap[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }

    /**
     * Calculate average progress for a student in a course.
     *
     * @param int $studentId
     * @param int $courseId
     * @return float
     */
    public static function calculateAverageProgress($studentId, $courseId)
    {
        $progresses = self::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->get();
        
        if ($progresses->isEmpty()) {
            return 0;
        }
        
        $totalPercentage = $progresses->sum('percentage');
        $average = $totalPercentage / $progresses->count();
        
        return round($average, 2);
    }

    /**
     * Get the last accessed content for a student in a course.
     *
     * @param int $studentId
     * @param int $courseId
     * @return CourseProgress|null
     */
    public static function getLastAccessedContent($studentId, $courseId)
    {
        return self::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->whereNotNull('last_accessed_at')
            ->orderBy('last_accessed_at', 'desc')
            ->first();
    }

    /**
     * Get next content to complete for a student in a course.
     *
     * @param int $studentId
     * @param int $courseId
     * @return CourseContent|null
     */
    public static function getNextContent($studentId, $courseId)
    {
        // Get all contents for the course
        $course = Course::with(['contents' => function($query) {
            $query->where('is_published', true)
                  ->orderBy('order_position', 'asc');
        }])->find($courseId);
        
        if (!$course) {
            return null;
        }
        
        // Get all progress records for this student and course
        $progresses = self::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->get()
            ->keyBy('content_id');
        
        // Find the first content that is not completed
        foreach ($course->contents as $content) {
            if (!isset($progresses[$content->id]) || !$progresses[$content->id]->isCompleted()) {
                return $content;
            }
        }
        
        return null;
    }

    /**
     * Get total time spent on a course by a student.
     *
     * @param int $studentId
     * @param int $courseId
     * @return int
     */
    public static function getTotalTimeSpent($studentId, $courseId)
    {
        return self::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->sum('duration');
    }

    /**
     * Get statistics for a student in a course.
     *
     * @param int $studentId
     * @param int $courseId
     * @return array
     */
    public static function getCourseStatistics($studentId, $courseId)
    {
        $totalContents = CourseContent::where('course_id', $courseId)
            ->where('is_published', true)
            ->count();
        
        $progresses = self::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->get();
        
        $completedContents = $progresses->where('status', self::STATUS_COMPLETED)->count();
        $inProgressContents = $progresses->where('status', self::STATUS_IN_PROGRESS)->count();
        $startedContents = $progresses->where('status', self::STATUS_STARTED)->count();
        $notStartedContents = $totalContents - ($completedContents + $inProgressContents + $startedContents);
        
        $totalTimeSpent = $progresses->sum('duration');
        
        return [
            'total_contents' => $totalContents,
            'completed_contents' => $completedContents,
            'in_progress_contents' => $inProgressContents,
            'started_contents' => $startedContents,
            'not_started_contents' => max(0, $notStartedContents),
            'completion_percentage' => $totalContents > 0 ? round(($completedContents / $totalContents) * 100, 2) : 0,
            'average_progress' => $progresses->isNotEmpty() ? round($progresses->avg('percentage'), 2) : 0,
            'total_time_spent' => $totalTimeSpent,
            'formatted_time_spent' => self::formatSeconds($totalTimeSpent),
            'last_accessed_at' => $progresses->max('last_accessed_at'),
            'first_started_at' => $progresses->min('started_at')
        ];
    }

    /**
     * Format seconds into human readable time.
     *
     * @param int $seconds
     * @return string
     */
    private static function formatSeconds($seconds)
    {
        if ($seconds < 60) {
            return $seconds . ' seconds';
        }
        
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        
        if ($hours > 0) {
            return sprintf('%d hour%s %d minute%s', 
                $hours, $hours > 1 ? 's' : '', 
                $minutes, $minutes > 1 ? 's' : '');
        } else {
            return sprintf('%d minute%s', $minutes, $minutes > 1 ? 's' : '');
        }
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($progress) {
            if (empty($progress->status)) {
                $progress->status = self::STATUS_NOT_STARTED;
            }
            
            if (empty($progress->last_accessed_at)) {
                $progress->last_accessed_at = now();
            }
        });

        static::updating(function ($progress) {
            // Automatically update status based on percentage
            if ($progress->isDirty('percentage')) {
                if ($progress->percentage >= 100) {
                    $progress->status = self::STATUS_COMPLETED;
                    if (empty($progress->completed_at)) {
                        $progress->completed_at = now();
                    }
                } elseif ($progress->percentage > 0 && $progress->percentage < 100) {
                    $progress->status = self::STATUS_IN_PROGRESS;
                }
            }
            
            // Update last accessed at on any change
            $progress->last_accessed_at = now();
        });

        static::saved(function ($progress) {
            // Update enrollment progress when content progress changes
            if ($progress->isDirty('percentage') || $progress->isDirty('status')) {
                $enrollment = Enrollment::where('student_id', $progress->student_id)
                    ->where('course_id', $progress->course_id)
                    ->first();
                
                if ($enrollment) {
                    $statistics = self::getCourseStatistics($progress->student_id, $progress->course_id);
                    
                    $enrollment->update([
                        'progress_percentage' => $statistics['completion_percentage'],
                        'last_accessed_at' => now(),
                        'completed_at' => $statistics['completion_percentage'] >= 100 ? now() : $enrollment->completed_at
                    ]);
                }
            }
        });
    }
}