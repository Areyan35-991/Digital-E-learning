<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Assignment;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display teacher dashboard
     */
    public function dashboard()
    {
        $teacher = Auth::user();
        
        Log::info('TEACHER DASHBOARD - Teacher Info', [
            'teacher_id' => $teacher->id,
            'teacher_name' => $teacher->name,
            'teacher_email' => $teacher->email
        ]);
        
        // FIX: Get courses by instructor_id (exact match)
        $assignedCourses = Course::where('instructor_id', $teacher->id)
                                ->latest()
                                ->get();
        
        // DEBUG: If no courses found by instructor_id, check by instructor name
        if ($assignedCourses->isEmpty()) {
            Log::warning('No courses found by instructor_id, checking by name', [
                'teacher_name' => $teacher->name
            ]);
            
            $assignedCourses = Course::where('instructor', 'like', '%' . $teacher->name . '%')
                                    ->latest()
                                    ->get();
        }
        
        Log::info('TEACHER DASHBOARD - Assigned Courses Found', [
            'total_courses_found' => $assignedCourses->count(),
            'courses' => $assignedCourses->pluck('title', 'id')->toArray()
        ]);
        
        // Calculate statistics
        $totalStudents = $assignedCourses->sum('enrolled_count');
        $totalLessons = $assignedCourses->sum('lessons');
        
        // Get recent content added by this teacher
        $recentContents = Lesson::whereHas('module.course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })->latest()->take(5)->get();
        
        return view('teacher.dashboard', compact(
            'assignedCourses', 
            'totalStudents', 
            'totalLessons',
            'recentContents'
        ));
    }
    
    /**
     * Manage specific course (Teacher's course management dashboard)
     */
    public function manageCourse($id)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $id)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $modules = $course->modules()->with('lessons')->orderBy('order')->get();
        $totalLessons = $course->lessons()->count();
        $totalAssignments = $course->assignments()->count();
        
        return view('teacher.courses.manage', compact(
            'course',
            'modules',
            'totalLessons',
            'totalAssignments'
        ));
    }
    
    /**
     * Create new module for course
     */
    public function createModule(Request $request, $courseId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer'
        ]);
        
        $module = $course->modules()->create([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? ($course->modules()->max('order') + 1),
            'teacher_id' => $teacher->id
        ]);
        
        return redirect()->back()->with('success', 'Module created successfully!');
    }
    
    /**
     * Update module
     */
    public function updateModule(Request $request, $courseId, $moduleId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $module = $course->modules()->findOrFail($moduleId);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer'
        ]);
        
        $module->update([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? $module->order
        ]);
        
        return redirect()->back()->with('success', 'Module updated successfully!');
    }
    
    /**
     * Delete module
     */
    public function deleteModule($courseId, $moduleId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $module = $course->modules()->findOrFail($moduleId);
        
        // Delete associated lessons first
        $module->lessons()->delete();
        
        $module->delete();
        
        return redirect()->back()->with('success', 'Module deleted successfully!');
    }
    
    /**
     * Create new lesson
     */
    public function createLesson(Request $request, $courseId, $moduleId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $module = $course->modules()->findOrFail($moduleId);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:video,reading,quiz,assignment',
            'duration' => 'nullable|integer',
            'order' => 'nullable|integer',
            'video_url' => 'nullable|url',
            'attachment' => 'nullable|file|max:10240' // 10MB max
        ]);
        
        $lessonData = [
            'title' => $request->title,
           // 'content' => $request->content,
            'type' => $request->type,
            'duration' => $request->duration ?? 0,
            'order' => $request->order ?? ($module->lessons()->max('order') + 1),
            'teacher_id' => $teacher->id
        ];
        
        // Handle video URL
        if ($request->type === 'video' && $request->video_url) {
            $lessonData['video_url'] = $request->video_url;
        }
        
        // Handle file attachment
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('course_materials', 'public');
            $lessonData['attachment_path'] = $path;
            $lessonData['attachment_name'] = $request->file('attachment')->getClientOriginalName();
        }
        
        $lesson = $module->lessons()->create($lessonData);
        
        // Update course lessons count
        $course->increment('lessons');
        
        return redirect()->back()->with('success', 'Lesson created successfully!');
    }
    
    /**
     * Update lesson
     */
    public function updateLesson(Request $request, $courseId, $moduleId, $lessonId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $module = $course->modules()->findOrFail($moduleId);
        $lesson = $module->lessons()->findOrFail($lessonId);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:video,reading,quiz,assignment',
            'duration' => 'nullable|integer',
            'order' => 'nullable|integer',
            'video_url' => 'nullable|url',
            'attachment' => 'nullable|file|max:10240'
        ]);
        
        $updateData = [
            'title' => $request->title,
           // 'content' => $request->content,
            'type' => $request->type,
            'duration' => $request->duration ?? $lesson->duration,
            'order' => $request->order ?? $lesson->order
        ];
        
        if ($request->type === 'video' && $request->video_url) {
            $updateData['video_url'] = $request->video_url;
        }
        
        // Handle file attachment
        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists
            if ($lesson->attachment_path) {
                Storage::disk('public')->delete($lesson->attachment_path);
            }
            
            $path = $request->file('attachment')->store('course_materials', 'public');
            $updateData['attachment_path'] = $path;
            $updateData['attachment_name'] = $request->file('attachment')->getClientOriginalName();
        }
        
        $lesson->update($updateData);
        
        return redirect()->back()->with('success', 'Lesson updated successfully!');
    }
    
    /**
     * Delete lesson
     */
    public function deleteLesson($courseId, $moduleId, $lessonId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $module = $course->modules()->findOrFail($moduleId);
        $lesson = $module->lessons()->findOrFail($lessonId);
        
        // Delete attachment if exists
        if ($lesson->attachment_path) {
            Storage::disk('public')->delete($lesson->attachment_path);
        }
        
        $lesson->delete();
        
        // Update course lessons count
        $course->decrement('lessons');
        
        return redirect()->back()->with('success', 'Lesson deleted successfully!');
    }
    
    /**
     * Create assignment
     */
    public function createAssignment(Request $request, $courseId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'total_marks' => 'required|integer|min:1',
            'type' => 'required|in:essay,quiz,project,presentation',
            'attachment' => 'nullable|file|max:20480' // 20MB max
        ]);
        
        $assignmentData = [
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'total_marks' => $request->total_marks,
            'type' => $request->type,
            'teacher_id' => $teacher->id
        ];
        
        // Handle file attachment
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('assignments', 'public');
            $assignmentData['attachment_path'] = $path;
            $assignmentData['attachment_name'] = $request->file('attachment')->getClientOriginalName();
        }
        
        $course->assignments()->create($assignmentData);
        
        return redirect()->back()->with('success', 'Assignment created successfully!');
    }
    
    /**
     * Update assignment
     */
    public function updateAssignment(Request $request, $courseId, $assignmentId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $assignment = $course->assignments()->findOrFail($assignmentId);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'total_marks' => 'required|integer|min:1',
            'type' => 'required|in:essay,quiz,project,presentation',
            'attachment' => 'nullable|file|max:20480'
        ]);
        
        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'total_marks' => $request->total_marks,
            'type' => $request->type
        ];
        
        // Handle file attachment
        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists
            if ($assignment->attachment_path) {
                Storage::disk('public')->delete($assignment->attachment_path);
            }
            
            $path = $request->file('attachment')->store('assignments', 'public');
            $updateData['attachment_path'] = $path;
            $updateData['attachment_name'] = $request->file('attachment')->getClientOriginalName();
        }
        
        $assignment->update($updateData);
        
        return redirect()->back()->with('success', 'Assignment updated successfully!');
    }
    
    /**
     * Delete assignment
     */
    public function deleteAssignment($courseId, $assignmentId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $assignment = $course->assignments()->findOrFail($assignmentId);
        
        // Delete attachment if exists
        if ($assignment->attachment_path) {
            Storage::disk('public')->delete($assignment->attachment_path);
        }
        
        $assignment->delete();
        
        return redirect()->back()->with('success', 'Assignment deleted successfully!');
    }
    
    /**
     * View assignment submissions
     */
    public function viewSubmissions($courseId, $assignmentId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $assignment = $course->assignments()->findOrFail($assignmentId);
        $submissions = $assignment->submissions()->with('student')->get();
        
        return view('teacher.assignments.submissions', compact(
            'course',
            'assignment',
            'submissions'
        ));
    }
    
    /**
     * Grade assignment submission
     */
    public function gradeSubmission(Request $request, $courseId, $assignmentId, $submissionId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $assignment = $course->assignments()->findOrFail($assignmentId);
        $submission = $assignment->submissions()->findOrFail($submissionId);
        
        $request->validate([
            'marks' => 'required|integer|min:0|max:' . $assignment->total_marks,
            'feedback' => 'nullable|string'
        ]);
        
        $submission->update([
            'marks' => $request->marks,
            'feedback' => $request->feedback,
            'graded_at' => now(),
            'teacher_id' => $teacher->id,
            'status' => 'graded'
        ]);
        
        return redirect()->back()->with('success', 'Submission graded successfully!');
    }
    
    /**
     * View student progress for a course
     */
    public function viewStudentProgress($courseId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $enrollments = $course->enrollments()
                            ->with('student')
                            ->orderBy('progress', 'desc')
                            ->get();
        
        return view('teacher.courses.progress', compact('course', 'enrollments'));
    }
    
    /**
     * Update course settings
     */
    public function updateCourseSettings(Request $request, $courseId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'skill_level' => 'required|in:Beginner,Intermediate,Advanced',
            'enrollment_key' => 'nullable|string|max:255',
            'is_published' => 'boolean'
        ]);
        
        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'skill_level' => $request->skill_level,
            'enrollment_key' => $request->enrollment_key,
            'is_published' => $request->has('is_published')
        ]);
        
        return redirect()->back()->with('success', 'Course settings updated successfully!');
    }
    
    /**
     * Upload course banner/image
     */
    public function uploadCourseImage(Request $request, $courseId)
    {
        $teacher = Auth::user();
        
        $course = Course::where('id', $courseId)
                        ->where('instructor_id', $teacher->id)
                        ->firstOrFail();
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ]);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }
            
            $path = $request->file('image')->store('course_banners', 'public');
            $course->update(['image' => $path]);
        }
        
        return redirect()->back()->with('success', 'Course image updated successfully!');
    }
    /**
 * Display student results search page
 */
public function resultsSearch()
{
    return view('teacher.results.search');
}

/**
 * Search student by ID
 */
public function searchStudentById($studentId)
{
    try {
        $student = User::where('id', $studentId)
                      ->where('role', 'student')
                      ->first();
        
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }
        
        // Get student's enrollments with grades
       $enrollments = Enrollment::where('student_id', $studentId)
                                ->with(['course', 'grades'])
                                ->get();
        
        // Organize by semester (you need to add semester field to courses/enrollments)
        $semesters = $this->organizeResultsBySemester($enrollments);
        
        // Calculate CGPA
        $cgpa = $this->calculateCGPA($enrollments);
        
        return response()->json([
            'success' => true,
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'department' => $student->department,
                'batch' => $student->batch,
                'program' => $student->program,
                'phone' => $student->phone,
                'avatar' => $student->avatar_url
            ],
            'summary' => [
                'cgpa' => $cgpa,
                'total_credits' => $enrollments->sum('course.credits'),
                'total_courses' => $enrollments->count(),
                'total_semesters' => count($semesters)
            ],
            'semesters' => $semesters
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Error searching student:', [
            'error' => $e->getMessage(),
            'student_id' => $studentId
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Error searching for student'
        ], 500);
    }
}

/**
 * Search student by name
 */
public function searchStudentByName($name)
{
    try {
        $students = User::where('role', 'student')
                       ->where(function($query) use ($name) {
                           $query->where('name', 'like', "%{$name}%")
                                 ->orWhere('id', 'like', "%{$name}%");
                       })
                       ->select('id', 'name', 'department', 'program')
                       ->limit(10)
                       ->get();
        
        return response()->json([
            'success' => true,
            'students' => $students
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Error searching student by name:', [
            'error' => $e->getMessage(),
            'name' => $name
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Error searching for student'
        ], 500);
    }
}

/**
 * Get student suggestions
 */
public function getStudentSuggestions($query)
{
    try {
        $suggestions = User::where('role', 'student')
                          ->where(function($q) use ($query) {
                              $q->where('name', 'like', "%{$query}%")
                                ->orWhere('id', 'like', "%{$query}%")
                                ->orWhere('email', 'like', "%{$query}%");
                          })
                          ->select('id', 'name', 'department')
                          ->limit(5)
                          ->get();
        
        return response()->json([
            'success' => true,
            'suggestions' => $suggestions
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'suggestions' => []
        ]);
    }
}

/**
 * Organize results by semester
 */
private function organizeResultsBySemester($enrollments)
{
    // Group by semester (assuming course has semester field)
    $grouped = $enrollments->groupBy(function($enrollment) {
        return $enrollment->course->semester;
    });
    
    $semesters = [];
    
    foreach ($grouped as $semesterName => $courses) {
        $totalCredits = $courses->sum('course.credits');
        $totalGradePoints = 0;
        
        $courseDetails = [];
        foreach ($courses as $enrollment) {
            $gradePoint = $this->calculateGradePoint($enrollment->final_grade);
            $totalGradePoints += $gradePoint * $enrollment->course->credits;
            
            $courseDetails[] = [
                'code' => $enrollment->course->code,
                'title' => $enrollment->course->title,
                'credits' => $enrollment->course->credits,
                'marks' => $enrollment->final_marks,
                'grade' => $enrollment->final_grade,
                'grade_point' => $gradePoint,
                'status' => $this->getStatus($enrollment->final_grade)
            ];
        }
        
        $gpa = $totalCredits > 0 ? $totalGradePoints / $totalCredits : 0;
        
        $semesters[] = [
            'name' => $semesterName,
            'year' => $this->extractYearFromSemester($semesterName),
            'credits' => $totalCredits,
            'gpa' => round($gpa, 2),
            'start_date' => $this->getSemesterDates($semesterName)['start'],
            'end_date' => $this->getSemesterDates($semesterName)['end'],
            'status' => 'completed',
            'courses' => $courseDetails
        ];
    }
    
    // Sort semesters by year and name
    usort($semesters, function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
    
    return $semesters;
}

/**
 * Calculate CGPA
 */
private function calculateCGPA($enrollments)
{
    $totalCredits = 0;
    $totalGradePoints = 0;
    
    foreach ($enrollments as $enrollment) {
        $gradePoint = $this->calculateGradePoint($enrollment->final_grade);
        $totalGradePoints += $gradePoint * $enrollment->course->credits;
        $totalCredits += $enrollment->course->credits;
    }
    
    return $totalCredits > 0 ? round($totalGradePoints / $totalCredits, 2) : 0;
}

/**
 * Calculate grade point from grade
 */
private function calculateGradePoint($grade)
{
    $gradePoints = [
        'A+' => 4.00, 'A' => 3.75, 'A-' => 3.50,
        'B+' => 3.25, 'B' => 3.0, 'B-' => 2.75,
        'C+' => 2.50, 'C' => 2.25, 'C-' => 2.00,
        'D+' => 1.5, 'D' => 1.0, 'F' => 0.00
    ];
    
    return $gradePoints[$grade] ?? 0.0;
}

/**
 * Get status from grade
 */
private function getStatus($grade)
{
    return in_array($grade, ['F', 'D', 'D+']) ? 'failed' : 'passed';
}

/**
 * Extract year from semester name
 */
private function extractYearFromSemester($semesterName)
{
    preg_match('/\d{4}/', $semesterName, $matches);
    return $matches[0] ?? date('Y');
}

/**
 * Get semester dates (example implementation)
 */
private function getSemesterDates($semesterName)
{
    // This is a simplified example - you should get actual dates from your database
    $year = $this->extractYearFromSemester($semesterName);
    
    if (strpos($semesterName, 'Spring') !== false) {
        return ['start' => "Jan {$year}", 'end' => "Apr {$year}"];
    } elseif (strpos($semesterName, 'Summer') !== false) {
        return ['start' => "May {$year}", 'end' => "Aug {$year}"];
    } else {
        return ['start' => "Sep {$year}", 'end' => "Dec {$year}"];
    }
}
}