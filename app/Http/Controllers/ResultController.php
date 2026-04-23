<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Semester;
use App\Models\Course;
use App\Models\StudentSummary;

class ResultController extends Controller
{
    // Show search page
    public function searchView()
    {
        return view('teacher.search');
    }

    // Search by student ID
    public function searchById($id)
    {
        try {
            $student = Student::with(['summary', 'semesters.courses'])
                ->where('id', $id)
                ->first();

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            $data = $this->formatStudentData($student);
            
            return response()->json([
                'success' => true,
                ...$data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving student data'
            ], 500);
        }
    }

    // Search by student name
    public function searchByName($name)
    {
        try {
            $students = Student::where('name', 'LIKE', "%{$name}%")
                ->limit(10)
                ->get();

            if ($students->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No students found with that name'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'students' => $students->map(function($student) {
                    return [
                        'id' => $student->id,
                        'name' => $student->name,
                        'department' => $student->department,
                        'batch' => $student->batch,
                        'program' => $student->program,
                        'avatar' => $student->avatar
                    ];
                })
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error searching for student'
            ], 500);
        }
    }

    // Get suggestions for autocomplete
    public function getSuggestions($query)
    {
        try {
            $suggestions = Student::where('name', 'LIKE', "{$query}%")
                ->orWhere('id', 'LIKE', "{$query}%")
                ->limit(5)
                ->get(['id', 'name', 'department', 'batch']);

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

    // Format student data for response
    private function formatStudentData($student)
    {
        $semesters = $student->semesters->map(function($semester) {
            return [
                'name' => $semester->name,
                'year' => $semester->year,
                'credits' => $semester->credits,
                'gpa' => $semester->gpa,
                'start_date' => $semester->start_date,
                'end_date' => $semester->end_date,
                'status' => $semester->status,
                'courses' => $semester->courses->map(function($course) {
                    return [
                        'code' => $course->code,
                        'title' => $course->title,
                        'credits' => $course->credits,
                        'marks' => $course->marks,
                        'grade' => $course->grade,
                        'grade_point' => $course->grade_point,
                        'status' => $course->status
                    ];
                })
            ];
        });

        return [
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'department' => $student->department,
                'batch' => $student->batch,
                'program' => $student->program,
                'email' => $student->email,
                'phone' => $student->phone,
                'avatar' => $student->avatar
            ],
            'summary' => $student->summary ? [
                'cgpa' => $student->summary->cgpa,
                'total_credits' => $student->summary->total_credits,
                'total_courses' => $student->summary->total_courses,
                'total_semesters' => $student->summary->total_semesters
            ] : [
                'cgpa' => 0.00,
                'total_credits' => 0,
                'total_courses' => 0,
                'total_semesters' => 0
            ],
            'semesters' => $semesters
        ];
    }
}