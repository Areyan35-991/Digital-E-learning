<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Show only published courses
        $courses = Course::where('is_published', true)->get();
        
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        // Fetch course
        $course = Course::where('is_published', true)->findOrFail($id);
        
        // Fetch instructor
        $instructor = User::find($course->instructor_id);
        
        // Check if current user is enrolled (if logged in)
        $isEnrolled = false;
        if (auth()->check() && auth()->user()->role === 'student') {
            $isEnrolled = Enrollment::where('student_id', auth()->id())
                ->where('course_id', $course->id)
                ->exists();
        }
        
        return view('courses.course-single', compact('course', 'instructor', 'isEnrolled'));
    }

    public function enroll(Request $request, $id)
    {
        // Only students can enroll
        if (auth()->user()->role !== 'student') {
            return redirect()->back()
                ->with('error', 'Only students can enroll in courses.');
        }
        
        $course = Course::where('is_published', true)->findOrFail($id);
        
        // Check if user is already enrolled
        $isEnrolled = Enrollment::where('student_id', auth()->id())
            ->where('course_id', $course->id)
            ->exists();
            
        if ($isEnrolled) {
            return redirect()->route('course.learn', $course->id)
                ->with('info', 'You are already enrolled in this course.');
        }
        
        // ALL COURSES REQUIRE ENROLLMENT KEY
        // Check if enrollment key is provided
        if (!$request->has('enrollment_key')) {
            return redirect()->back()
                ->with('error', 'Enrollment key is required for this course.')
                ->withInput();
        }
        
        // Validate enrollment key
        $request->validate([
            'enrollment_key' => 'required|string'
        ]);
        
        // Check enrollment key
        if ($request->enrollment_key !== $course->enrollment_key) {
            return redirect()->back()
                ->with('error', 'Invalid enrollment key. Please check with your instructor.')
                ->withInput();
        }
        
        // Enroll user in course
        Enrollment::create([
            'student_id' => auth()->id(),
            'course_id' => $course->id,
            'enrolled_at' => now(),
            'progress' => 0,
            'last_accessed_at' => now(),
        ]);
        
        // Update enrolled count
        $course->increment('enrolled_count');
        
        return redirect()->route('course.learn', $course->id)
            ->with('success', 'Successfully enrolled in the course!');
    }

    public function enrollWithKey(Request $request, $id)
    {
        // Only students can enroll
        if (auth()->user()->role !== 'student') {
            return redirect()->back()
                ->with('error', 'Only students can enroll in courses.');
        }
        
        $request->validate([
            'enrollment_key' => 'required|string'
        ]);
        
        $course = Course::where('is_published', true)->findOrFail($id);
        
        // Check if user is already enrolled
        $isEnrolled = Enrollment::where('student_id', auth()->id())
            ->where('course_id', $course->id)
            ->exists();
            
        if ($isEnrolled) {
            return redirect()->route('courses.course-learn', $course->id)
                ->with('info', 'You are already enrolled in this course.');
        }
        
        // Check enrollment key
        if ($request->enrollment_key !== $course->enrollment_key) {
            return back()->with('error', 'Invalid enrollment key. Please check with your instructor.');
        }
        
        // Enroll user
        Enrollment::create([
            'student_id' => auth()->id(),
            'course_id' => $course->id,
            'enrolled_at' => now(),
            'progress' => 0,
            'last_accessed_at' => now(),
        ]);
        
        // Update enrolled count
        $course->increment('enrolled_count');
        
        return redirect()->route('courses.course-learn', $course->id)
            ->with('success', 'Successfully enrolled in the course!');
    }

    public function learn($id)
    {
        // Only students can access learning
        if (auth()->user()->role !== 'student') {
            return redirect()->back()
                ->with('error', 'Only students can access course learning.');
        }
        
        $course = Course::where('is_published', true)->findOrFail($id);
        
        // Check if user is enrolled
        $enrollment = Enrollment::where('student_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();
            
        if (!$enrollment) {
            return redirect()->route('course.show', $course->id)
                ->with('error', 'You need to enroll in this course first.');
        }
        
        // Update last accessed time
        $enrollment->update(['last_accessed_at' => now()]);
        
        // Get course contents (only published)
        $contents = $course->contents()
            ->where('is_published', true)
            ->orderBy('order')
            ->orderBy('created_at')
            ->get();
        
        return view('courses.course-learn', compact('course', 'contents', 'enrollment'));
    }
}