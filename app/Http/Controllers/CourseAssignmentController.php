<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseAssignmentController extends Controller
{
    public function assignTeachers(Request $request, Course $course)
    {
        $request->validate([
            'instructor_ids' => 'required|array',
            'instructor_ids.*' => 'exists:users,id'
        ]);

        $course->teachers()->sync($request->instructor_ids);

        return redirect()->back()->with('success', 'Teachers assigned successfully!');
    }

    public function getCourseTeachers(Course $course)
    {
        return $course->teachers()->wherePivot('is_active', true)->get();
    }
}

