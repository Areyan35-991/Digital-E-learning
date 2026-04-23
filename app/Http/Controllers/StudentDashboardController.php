<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\CalendarEvent;
use App\Models\StudentProgress;
use App\Models\Course;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'student') {
                abort(403, 'Unauthorized access.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $studentId = auth()->id();
        
        // Get dashboard statistics
        $statistics = $this->getDashboardStatistics($studentId);
        
        // Get recently accessed courses (last 5)
        $recentCourses = Enrollment::where('student_id', $studentId)
            ->with('course')
            ->orderBy('last_accessed_at', 'desc')
            ->take(6)
            ->get();
        
        // Get upcoming events (next 30 days)
        $upcomingEvents = CalendarEvent::whereHas('course.enrollments', function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->where('event_date', '>=', now())
            ->where('event_date', '<=', now()->addDays(30))
            ->with('course')
            ->orderBy('event_date')
            ->get()
            ->take(5);

        return view('student.dashboard', compact('statistics', 'recentCourses', 'upcomingEvents'));
    }

   public function myCourses()
{
    $studentId = auth()->id();
    
    // Remove the 'teachers' relationship from with() if it doesn't exist
    $enrollments = Enrollment::where('student_id', $studentId)
        ->with(['course' => function($query) {
            // Only load course and contents, skip teachers if relationship doesn't exist
            $query->with('contents');
        }])
        ->orderBy('last_accessed_at', 'desc')
        ->get();

    return view('student.courses', compact('enrollments'));
}

    /**
     * Show leaderboard page
     */
    public function leaderboard()
    {
        $studentId = auth()->id();
        
        // Get all students with their statistics
        $students = User::where('role', 'student')
            ->with(['enrollments' => function($query) {
                $query->selectRaw('student_id, AVG(progress) as avg_progress')
                    ->groupBy('student_id');
            }])
            ->get()
            ->map(function($student) {
                $avgProgress = $student->enrollments->first()->avg_progress ?? 0;
                
                // Calculate score based on various factors
                $score = ($student->enrollments_count * 100) + 
                         ($student->completed_activities_count * 10) + 
                         ($avgProgress * 5) + 
                         rand(50, 200); // Add some random factor for demo
                
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'score' => round($score),
                    'enrolled_courses' => $student->enrollments_count,
                    'completed_activities' => $student->completed_activities_count,
                    'avg_progress' => round($avgProgress, 1),
                    'streak' => rand(1, 50), // You would implement actual streak logic
                ];
            })
            ->sortByDesc('score')
            ->values()
            ->take(20);

        // Find current user's rank
        $currentUserRank = $students->search(function($student) use ($studentId) {
            return $student['id'] === $studentId;
        });

        // Add rank to each student
        $students = $students->map(function($student, $index) {
            $student['rank'] = $index + 1;
            return (object) $student;
        });

        // Get current user data
        $currentUser = $students->firstWhere('id', $studentId);

        // If current user is not in top 20, add them at the end
        if (!$currentUser) {
            $user = User::find($studentId);
            $currentUser = (object) [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'score' => rand(800, 1500),
                'enrolled_courses' => Enrollment::where('student_id', $studentId)->count(),
                'completed_activities' => StudentProgress::where('student_id', $studentId)
                    ->where('is_completed', true)
                    ->count(),
                'avg_progress' => round(Enrollment::where('student_id', $studentId)->avg('progress') ?? 0, 1),
                'streak' => rand(1, 30),
                'rank' => $currentUserRank !== false ? $currentUserRank + 1 : 21
            ];
        }

        return view('student.leaderboard', compact('students', 'currentUser'));
    }

    /**
     * Show upcoming events page
     */
    public function events()
    {
        $studentId = auth()->id();
        
        // Get all upcoming events
        $events = CalendarEvent::whereHas('course.enrollments', function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->where('event_date', '>=', now())
            ->with('course')
            ->orderBy('event_date')
            ->get()
            ->map(function($event) {
                return (object) [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'event_date' => $event->event_date,
                    'event_time' => $event->event_time,
                    'event_type' => $event->event_type,
                    'course_name' => $event->course->title ?? 'No Course',
                    'instructor' => $event->course->teachers->first()->name ?? 'Unknown',
                    'weight' => $event->weight,
                    'location' => $event->location,
                    'duration' => $event->duration
                ];
            });

        // If no events found, create sample data for demo
        if ($events->isEmpty()) {
            $events = collect([
                (object)[
                    'id' => 1,
                    'title' => 'Mid-term Quiz: Algorithms & Data Structures',
                    'description' => 'Comprehensive quiz covering topics from chapters 1-5. Includes multiple choice, short answer, and coding problems.',
                    'event_date' => now()->addDays(3),
                    'event_time' => '10:00 AM - 11:30 AM',
                    'event_type' => 'quiz',
                    'course_name' => 'Computer Science 201',
                    'instructor' => 'Dr. Sarah Johnson',
                    'weight' => '15% of final grade',
                    'location' => 'Online',
                    'duration' => '90 minutes'
                ],
                (object)[
                    'id' => 2,
                    'title' => 'Programming Assignment #3: Binary Search Trees',
                    'description' => 'Implement a binary search tree with insert, delete, search, and traversal operations.',
                    'event_date' => now()->addDays(5),
                    'event_time' => '11:59 PM',
                    'event_type' => 'assignment',
                    'course_name' => 'Computer Science 201',
                    'instructor' => 'Dr. Sarah Johnson',
                    'weight' => '10% of final grade',
                    'location' => 'Online Submission',
                    'duration' => null
                ],
                (object)[
                    'id' => 3,
                    'title' => 'Final Project Report: Machine Learning Application',
                    'description' => 'Submit complete project report including methodology, implementation, results, and analysis.',
                    'event_date' => now()->addDays(7),
                    'event_time' => '11:59 PM',
                    'event_type' => 'project',
                    'course_name' => 'Artificial Intelligence',
                    'instructor' => 'Prof. Michael Chen',
                    'weight' => '25% of final grade',
                    'location' => 'Online Submission',
                    'duration' => null
                ]
            ]);
        }

        // Group events by date for timeline view
        $groupedEvents = $events->groupBy(function($event) {
            return $event->event_date->format('Y-m-d');
        });

        return view('student.events', compact('events', 'groupedEvents'));
    }

    public function updateLastAccessed(Request $request, $courseId)
    {
        $enrollment = Enrollment::where('student_id', auth()->id())
            ->where('course_id', $courseId)
            ->first();

        if ($enrollment) {
            $enrollment->update([
                'last_accessed_at' => now()
            ]);
        }

        return response()->json(['success' => true]);
    }

    private function getDashboardStatistics($studentId)
    {
        $totalEnrolled = Enrollment::where('student_id', $studentId)->count();
        
        $completedCourses = Enrollment::where('student_id', $studentId)
            ->where('progress', '>=', 100)
            ->count();
            
        $completedActivities = StudentProgress::where('student_id', $studentId)
            ->where('is_completed', true)
            ->count();

        $currentProgress = Enrollment::where('student_id', $studentId)
            ->avg('progress');

        return [
            'enrolled_courses' => $totalEnrolled,
            'completed_courses' => $completedCourses,
            'completed_activities' => $completedActivities,
            'average_progress' => round($currentProgress, 1)
        ];
    }

    public function getCalendarEvents(Request $request)
    {
        $studentId = auth()->id();
        
        $events = CalendarEvent::whereHas('course.enrollments', function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->whereBetween('event_date', [
                $request->start ?? now()->startOfMonth(),
                $request->end ?? now()->endOfMonth()
            ])
            ->with('course')
            ->get()
            ->map(function($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->event_date->format('Y-m-d'),
                    'description' => $event->description,
                    'type' => $event->event_type,
                    'course' => $event->course->title,
                    'allDay' => $event->is_all_day
                ];
            });

        return response()->json($events);
    }

    /**
     * Get student statistics for leaderboard
     */
    private function getStudentStatistics($studentId)
    {
        return [
            'enrolled_courses' => Enrollment::where('student_id', $studentId)->count(),
            'completed_courses' => Enrollment::where('student_id', $studentId)
                ->where('progress', '>=', 100)
                ->count(),
            'completed_activities' => StudentProgress::where('student_id', $studentId)
                ->where('is_completed', true)
                ->count(),
            'avg_progress' => round(Enrollment::where('student_id', $studentId)->avg('progress') ?? 0, 1),
            'streak' => $this->calculateLoginStreak($studentId)
        ];
    }

    /**
     * Calculate login streak (simplified version)
     */
    private function calculateLoginStreak($studentId)
    {
        // Simplified - you would implement actual streak logic
        return rand(1, 30);
    }
}