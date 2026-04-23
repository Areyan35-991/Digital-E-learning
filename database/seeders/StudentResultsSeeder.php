<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\StudentSummary;
use App\Models\Semester;
use App\Models\Course;

class StudentResultsSeeder extends Seeder
{
    public function run()
    {
        // Create student
        $student = Student::create([
            'id' => '221-35-991',
            'name' => 'Irfan Kafil Areyan',
            'department' => 'Software Engineering',
            'batch' => '221',
            'program' => 'B.Sc. in Software Engineering',
            'email' => 'john.doe@example.com',
            'phone' => '+880 1234 567890',
            'avatar' => '/images/default-avatar.png'
        ]);

        // Create summary
        $summary = StudentSummary::create([
            'student_id' => $student->id,
            'cgpa' => 3.75,
            'total_credits' => 45,
            'total_courses' => 15,
            'total_semesters' => 3
        ]);

        // Semester 1: Fall 2023
        $semester1 = Semester::create([
            'student_id' => $student->id,
            'name' => 'Fall 2023',
            'year' => '2023',
            'credits' => 15,
            'gpa' => 3.8,
            'start_date' => 'Sep 2023',
            'end_date' => 'Dec 2023',
            'status' => 'completed'
        ]);

        $semester1Courses = [
            ['code' => 'SE101', 'title' => 'Introduction to Programming', 'credits' => 3, 'marks' => 85, 'grade' => 'A+', 'grade_point' => 4.00, 'status' => 'passed'],
            ['code' => 'MAT101', 'title' => 'Calculus I', 'credits' => 3, 'marks' => 88, 'grade' => 'A+', 'grade_point' => 4.00, 'status' => 'passed'],
            ['code' => 'ENG101', 'title' => 'English Composition', 'credits' => 3, 'marks' => 70, 'grade' => 'A-', 'grade_point' => 3.75, 'status' => 'passed'],
            ['code' => 'PHY101', 'title' => 'Physics I', 'credits' => 3, 'marks' => 70, 'grade' => 'B+', 'grade_point' => 3.3, 'status' => 'passed'],
            ['code' => 'SE100', 'title' => 'Computer Fundamentals', 'credits' => 3, 'marks' => 92, 'grade' => 'A+', 'grade_point' => 4.00, 'status' => 'passed']
        ];

        foreach ($semester1Courses as $courseData) {
            Course::create(array_merge($courseData, ['semester_id' => $semester1->id]));
        }

        // Semester 2: Spring 2024
        $semester2 = Semester::create([
            'student_id' => $student->id,
            'name' => 'Spring 2024',
            'year' => '2024',
            'credits' => 15,
            'gpa' => 3.7,
            'start_date' => 'Jan 2024',
            'end_date' => 'Apr 2024',
            'status' => 'completed'
        ]);

        $semester2Courses = [
            ['code' => 'SE201', 'title' => 'Data Structures', 'credits' => 3, 'marks' => 87, 'grade' => 'A+', 'grade_point' => 4.00, 'status' => 'passed'],
            ['code' => 'MAT201', 'title' => 'Discrete Mathematics', 'credits' => 3, 'marks' => 85, 'grade' => 'A+', 'grade_point' => 4.00, 'status' => 'passed'],
            ['code' => 'SE203', 'title' => 'Digital Logic Design', 'credits' => 3, 'marks' => 78, 'grade' => 'A-', 'grade_point' => 3.75, 'status' => 'passed'],
            ['code' => 'STA201', 'title' => 'Statistics', 'credits' => 3, 'marks' => 65, 'grade' => 'B+', 'grade_point' => 3.25, 'status' => 'passed'],
            ['code' => 'SE205', 'title' => 'Object Oriented Programming', 'credits' => 3, 'marks' => 90, 'grade' => 'A+', 'grade_point' => 4.00, 'status' => 'passed']
        ];

        foreach ($semester2Courses as $courseData) {
            Course::create(array_merge($courseData, ['semester_id' => $semester2->id]));
        }

        // Semester 3: Summer 2024
        $semester3 = Semester::create([
            'student_id' => $student->id,
            'name' => 'Summer 2024',
            'year' => '2024',
            'credits' => 15,
            'gpa' => 3.75,
            'start_date' => 'May 2024',
            'end_date' => 'Aug 2024',
            'status' => 'completed'
        ]);

        $semester3Courses = [
            ['code' => 'SE301', 'title' => 'Algorithms', 'credits' => 3, 'marks' => 89, 'grade' => 'A+', 'grade_point' => 4.00, 'status' => 'passed'],
            ['code' => 'SE303', 'title' => 'Database Systems', 'credits' => 3, 'marks' => 84, 'grade' => 'A+', 'grade_point' => 4.00, 'status' => 'passed'],
            ['code' => 'SE305', 'title' => 'Computer Architecture', 'credits' => 3, 'marks' => 75, 'grade' => 'A-', 'grade_point' => 3.75, 'status' => 'passed'],
            ['code' => 'MAT301', 'title' => 'Linear Algebra', 'credits' => 3, 'marks' => 72, 'grade' => 'B+', 'grade_point' => 3.25, 'status' => 'passed'],
            ['code' => 'SE307', 'title' => 'Software Engineering', 'credits' => 3, 'marks' => 88, 'grade' => 'A', 'grade_point' => 4.00, 'status' => 'passed']
        ];

        foreach ($semester3Courses as $courseData) {
            Course::create(array_merge($courseData, ['semester_id' => $semester3->id]));
        }

        // Create some additional sample students
        $this->createAdditionalStudents();

        $this->command->info('Student results seeded successfully!');
    }

    private function createAdditionalStudents()
    {
        $students = [
            [
                'id' => '221-35-992',
                'name' => 'Sarah Johnson',
                'department' => 'Computer Science',
                'batch' => '221',
                'program' => 'B.Sc. in Computer Science',
                'email' => 'sarah.j@example.com',
                'phone' => '+880 1234 567891',
                'avatar' => '/images/default-avatar.png'
            ],
            [
                'id' => '221-35-993',
                'name' => 'Michael Brown',
                'department' => 'Software Engineering',
                'batch' => '221',
                'program' => 'B.Sc. in Software Engineering',
                'email' => 'michael.b@example.com',
                'phone' => '+880 1234 567892',
                'avatar' => '/images/default-avatar.png'
            ],
            [
                'id' => '221-35-994',
                'name' => 'Emma Wilson',
                'department' => 'Information Technology',
                'batch' => '221',
                'program' => 'B.Sc. in IT',
                'email' => 'emma.w@example.com',
                'phone' => '+880 1234 567893',
                'avatar' => '/images/default-avatar.png'
            ]
        ];

        foreach ($students as $studentData) {
            Student::create($studentData);
        }
    }
}