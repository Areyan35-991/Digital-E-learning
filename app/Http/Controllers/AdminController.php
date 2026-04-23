<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_courses' => Course::count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_students' => User::where('role', 'student')->count(),
            'active_semester' => 'Fall 2025',
            'enrolled_count' => Course::sum('enrolled_count'),
            

        ];
        
        return view('admin.dashboard', compact('stats'));
    }
    
    /**
     * Display all users
     */
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }
    
    /**
     * Display all courses
     */
  public function courses()
{
    $courses = Course::with('assignedTeacher')->latest()->paginate(10);
    $teachers = User::where('role', 'teacher')->get(); // Add this line
    
    return view('admin.courses', compact('courses', 'teachers')); // Update this line
}
    
    /**
     * Display all teachers/faculty
     */
    public function teachers()
    {
        $teachers = User::where('role', 'teacher')->latest()->paginate(10);
        return view('admin.teachers', compact('teachers'));
    }
    
    /**
     * Show form to create new teacher
     */
    public function createTeacher()
    {
        return view('admin.teachers-create');
    }
    
    /**
     * Store new teacher
     */
    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users',
                function ($attribute, $value, $fail) {
                    if (!User::isEducationalEmail($value)) {
                        $fail('Please use an educational institution email address.');
                    }
                }
            ],
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
            'email_verified' => true,
            'email_domain' => substr(strrchr($request->email, "@"), 1),
        ]);
        
        return redirect()->route('admin.teachers')->with('success', 'Teacher added successfully!');
    }
    
    /**
     * Assign course to teacher
     */
    public function assignCourse(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $course->instructor_id = $request->instructor_id;
        $course->save();
        
         $course = Course::findOrFail($courseId);
    
    $request->validate([
        'instructor_id' => 'required|exists:users,id',
    ]);

    $teacher = User::findOrFail($request->instructor_id);
    
     [
        'course_before' => $course->toArray(),
        'teacher' => $teacher->toArray()
    ];
    
    $course->update([
        'instructor_id' => $teacher->id,
        'instructor' => $teacher->name,
    ]);

    \Log::info('After update', [
        'course_after' => $course->fresh()->toArray()
    ]);

    return redirect()->route('admin.courses')->with('success', 'Teacher assigned successfully!');
}
    
    
    /**
     * Show teacher details
     */
    public function showTeacher($id)
    {
        $teacher = User::where('id', $id)->where('role', 'teacher')->firstOrFail();
        $assignedCourses = Course::where('instructor_id', $id)->get();
        
        return view('admin.teacher-show', compact('teacher', 'assignedCourses'));
    }
    
    /**
     * Edit teacher form
     */
    public function editTeacher($id)
    {
        $teacher = User::where('id', $id)->where('role', 'teacher')->firstOrFail();
        return view('admin.teachers-edit', compact('teacher'));
    }
    
    /**
     * Update teacher
     */
    public function updateTeacher(Request $request, $id)
    {
        $teacher = User::where('id', $id)->where('role', 'teacher')->firstOrFail();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $teacher->id,
                function ($attribute, $value, $fail) {
                    if (!User::isEducationalEmail($value)) {
                        $fail('Please use an educational institution email address.');
                    }
                }
            ],
        ]);
        
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'email_domain' => substr(strrchr($request->email, "@"), 1),
        ]);
        
        return redirect()->route('admin.teachers')->with('success', 'Teacher updated successfully!');
    }
    
    /**
     * Delete teacher
     */
    public function destroyTeacher($id)
    {
        $teacher = User::where('id', $id)->where('role', 'teacher')->firstOrFail();
        
        // Check if teacher has assigned courses
        $assignedCourses = Course::where('instructor_id', $id)->count();
        if ($assignedCourses > 0) {
            return redirect()->route('admin.teachers')->with('error', 'Cannot delete teacher with assigned courses. Please reassign courses first.');
        }
        
        $teacher->delete();
        
        return redirect()->route('admin.teachers')->with('success', 'Teacher deleted successfully!');
    }
    /**
 * Unassign teacher from course
 */
public function unassignTeacher($courseId)
{
    $course = Course::findOrFail($courseId);
    
    $course->update([
        'instructor_id' => null,
        'instructor' => null,
    ]);

    return redirect()->route('admin.courses')->with('success', 'Teacher unassigned successfully!');
}
/**
 * Bulk assign teachers view
 */
public function showBulkAssignment()
{
    $courses = Course::whereNull('instructor_id')->get();
    $teachers = User::where('role', 'teacher')->get();
    
    return view('admin.bulk-assignment', compact('courses', 'teachers'));
}
/**
 * Process bulk assignment
 */
public function bulkAssignTeachers(Request $request)
{
    $assignments = $request->assignments;
    
    foreach ($assignments as $courseId => $teacherId) {
        if ($teacherId) {
            $course = Course::find($courseId);
            $teacher = User::find($teacherId);
            
            if ($course && $teacher) {
                $course->update([
                    'instructor_id' => $teacher->id,
                    'instructor' => $teacher->name,
                ]);
            }
        }
    }

    return redirect()->route('admin.courses')->with('success', 'Teachers assigned in bulk successfully!');
}
    
    /**
     * Show course details
     */
    public function showCourse($id)
    {
        $course = Course::findOrFail($id);
        $teachers = User::where('role', 'teacher')->get();
        
        return view('admin.course-show', compact('course', 'teachers'));
    }
    
    /**
     * Create new course form
     */
    public function createCourse()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.courses-create', compact('teachers'));
    }
    
    /**
     * Store new course
     */
    public function storeCourse(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:courses',
            'description' => 'required|string',
            'instructor' => 'required|string|max:255',
            'enrollment_key' => 'required|string|max:255|unique:courses',
            'category' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'skill_level' => 'required|in:Beginner,Intermediate,Advanced',
            'lessons' => 'required|integer|min:1',
            'duration_weeks' => 'required|integer|min:1',
            'image' => 'nullable|url|max:255',

        ]);
        
        Course::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'instructor' => $request->instructor,
            'instructor_id' => $request->instructor_id,
            'enrollment_key' => $request->enrollment_key,
            'category' => $request->category,
            'semester' => $request->semester,
            'language' => $request->language,
            'skill_level' => $request->skill_level,
            'lessons' => $request->lessons,
            'duration_weeks' => $request->duration_weeks,
            'enrolled_count' => 0,
            'image' => $request->image,
           
        ]);
        
        return redirect()->route('admin.courses')->with('success', 'Course created successfully!');
    }
    
    /**
     * Edit course form
     */
    public function editCourse($id)
    {
        $course = Course::findOrFail($id);
        $teachers = User::where('role', 'teacher')->get();
        
        return view('admin.courses-edit', compact('course', 'teachers'));
    }
    
    /**
     * Update course
     */
    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:courses,slug,' . $course->id,
            'description' => 'required|string',
            'instructor' => 'required|string|max:255',
            'enrollment_key' => 'required|string|max:255|unique:courses,enrollment_key,' . $course->id,
            'category' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'skill_level' => 'required|in:Beginner,Intermediate,Advanced',
            'lessons' => 'required|integer|min:1',
            'duration_weeks' => 'required|integer|min:1',
            'image' => 'nullable|url|max:255',
        ]);
        
        $course->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'instructor' => $request->instructor,
            'instructor_id' => $request->instructor_id,
            'enrollment_key' => $request->enrollment_key,
            'category' => $request->category,
            'semester' => $request->semester,
            'language' => $request->language,
            'skill_level' => $request->skill_level,
            'lessons' => $request->lessons,
            'duration_weeks' => $request->duration_weeks,
            'image' => $request->image,
           
        ]);
        
        return redirect()->route('admin.courses')->with('success', 'Course updated successfully!');
    }
    
    /**
     * Delete course
     */
    public function destroyCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        
        return redirect()->route('admin.courses')->with('success', 'Course deleted successfully!');
    }
    
    /**
     * Toggle course publish status
     */
    public function toggleCoursePublish($id)
    {
        $course = Course::findOrFail($id);
        $course->update([
            'is_published' => !$course->is_published
        ]);
        
        $status = $course->is_published ? 'published' : 'unpublished';
        return redirect()->route('admin.courses')->with('success', "Course {$status} successfully!");
    }
    
    /**
     * Show user details
     */
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        $enrolledCourses = []; // You can implement enrollment logic later
        
        return view('admin.user-show', compact('user', 'enrolledCourses'));
    }
    
    /**
     * Update user role
     */
    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'role' => 'required|in:admin,teacher,student',
        ]);
        
        $user->update([
            'role' => $request->role,
        ]);
        
        return redirect()->route('admin.users')->with('success', 'User role updated successfully!');
    }
    
}