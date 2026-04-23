<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();

        // Grade mapping
        $gradeRanges = [
            [90, 100, 'A+', 4.00],
            [85, 89, 'A', 3.75],
            [80, 84, 'A-', 3.50],
            [75, 79, 'B+', 3.25],
            [70, 74, 'B', 3.00],
            [65, 69, 'B-', 2.75],
            [60, 64, 'C+', 2.50],
            [55, 59, 'C', 2.25],
            [50, 54, 'C-', 2.00],
            [45, 49, 'D+', 1.5],
            [40, 44, 'D', 1.0],
            [0, 39, 'F', 0.00]
        ];

        // Create enrollments for each student
        foreach ($students as $student) {
            // Determine which semesters this student has completed
            // Assuming batch 2022 students have completed:
            // Fall 2022, Spring 2023, Fall 2023, Spring 2024
            
            $completedSemesters = [
                'Fall 2022',
                'Spring 2023', 
                'Fall 2023',
                'Spring 2024'
            ];
            
            $currentSemester = 'Fall 2024'; // Current semester

            // Enroll in completed semester courses with grades
            foreach ($completedSemesters as $semester) {
                $semesterCourses = $courses->where('semester', $semester)->take(rand(4, 5));
                
                foreach ($semesterCourses as $course) {
                    $marks = rand(60, 95); // Most students get good marks
                    
                    // Determine grade
                    foreach ($gradeRanges as $range) {
                        if ($marks >= $range[0] && $marks <= $range[1]) {
                            $grade = $range[2];
                            $gradePoint = $range[3];
                            break;
                        }
                    }

                    Enrollment::create([
                        'student_id' => $student->id,
                        'course_id' => $course->id,
                        'semester' => $semester,
                        'final_marks' => $marks,
                        'final_grade' => $grade,
                        'grade_point' => $gradePoint,
                        'status' => 'completed',
                        'enrolled_at' => $this->getSemesterStartDate($semester),
                        'completed_at' => $this->getSemesterEndDate($semester),
                    ]);
                }
            }

            // Enroll in current semester courses (no grades yet)
            $currentCourses = $courses->where('semester', $currentSemester)->take(rand(4, 5));
            
            foreach ($currentCourses as $course) {
                Enrollment::create([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'semester' => $currentSemester,
                    'status' => 'in-progress',
                    'enrolled_at' => $this->getSemesterStartDate($currentSemester),
                ]);
            }
        }
    }

    /**
     * Get semester start date
     */
    private function getSemesterStartDate($semester)
    {
        $year = substr($semester, -4);
        
        if (strpos($semester, 'Fall') !== false) {
            return "{$year}-09-01";
        } elseif (strpos($semester, 'Spring') !== false) {
            return "{$year}-01-15";
        } elseif (strpos($semester, 'Summer') !== false) {
            return "{$year}-05-15";
        }
        
        return "{$year}-01-01";
    }

    /**
     * Get semester end date
     */
    private function getSemesterEndDate($semester)
    {
        $year = substr($semester, -4);
        
        if (strpos($semester, 'Fall') !== false) {
            return "{$year}-12-15";
        } elseif (strpos($semester, 'Spring') !== false) {
            return "{$year}-04-30";
        } elseif (strpos($semester, 'Summer') !== false) {
            return "{$year}-08-15";
        }
        
        return "{$year}-12-31";
    }
}