<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Database Systems - CS401',
                'slug' => 'database-systems-cs401',
                'description' => 'Learn database management systems, SQL, and data modeling with practical examples. Course covers relational databases, normalization, and query optimization for academic projects.',
                'instructor' => null,
                'enrollment_key' => 'DBSYSTEMS2025',
                'category' => 'Computer Science',
                'semester' => 'Fall 2025',
                'language' => 'English',
                'skill_level' => 'Intermediate',
                'lessons' => 14,
                'duration_weeks' => 14,
                'enrolled_count' => 45,
                'image' => 'https://cdn.pixabay.com/photo/2017/08/06/15/13/database-2596017_1280.png',
                'is_published' => true,
            ],
            [
                'title' => 'Web Technologies - CS402',
                'slug' => 'web-technologies-cs402',
                'description' => 'Comprehensive course covering HTML, CSS, JavaScript and modern web development frameworks. Build academic projects and learn industry best practices.',
                'instructor' => null,
                'enrollment_key' => 'WEBTECH2025',
                'category' => 'Computer Science',
                'semester' => 'Fall 2025',
                'language' => 'English',
                'skill_level' => 'Beginner',
                'lessons' => 12,
                'duration_weeks' => 10,
                'enrolled_count' => 52,
                'image' => 'https://cdn.pixabay.com/photo/2016/11/19/22/25/css-1841590_1280.jpg',
                'is_published' => true,
            ],
            [
                'title' => 'Machine Learning - CS501',
                'slug' => 'machine-learning-cs501',
                'description' => 'Advanced course covering machine learning algorithms, neural networks, and AI concepts. Includes practical labs and research projects.',
                'instructor' => null,
                'enrollment_key' => 'MLADV2025',
                'category' => 'Computer Science',
                'semester' => 'Fall 2025',
                'language' => 'English',
                'skill_level' => 'Advanced',
                'lessons' => 16,
                'duration_weeks' => 12,
                'enrolled_count' => 38,
                'image' => 'https://cdn.pixabay.com/photo/2018/05/08/08/44/artificial-intelligence-3382507_1280.jpg',
                'is_published' => true,
            ],
            [
                'title' => 'Mathematics for Computing - MTH301',
                'slug' => 'mathematics-computing-mth301',
                'description' => 'Essential mathematical concepts for computer science including discrete mathematics, calculus, and linear algebra applications.',
                'instructor' => null,
                'enrollment_key' => 'MATHCOMP2025',
                'category' => 'Mathematics',
                'semester' => 'Fall 2025',
                'language' => 'English',
                'skill_level' => 'Intermediate',
                'lessons' => 15,
                'duration_weeks' => 13,
                'enrolled_count' => 67,
                'image' => 'https://cdn.pixabay.com/photo/2017/01/31/18/34/blackboard-2026163_1280.png',
                'is_published' => true,
            ],
            [
                'title' => 'Software Engineering - CS403',
                'slug' => 'software-engineering-cs403',
                'description' => 'Learn software development methodologies, project management, and team collaboration. Work on semester-long group projects.',
                'instructor' => null,
                'enrollment_key' => 'SOFTENG2025',
                'category' => 'Computer Science',
                'semester' => 'Fall 2025',
                'language' => 'English',
                'skill_level' => 'Intermediate',
                'lessons' => 14,
                'duration_weeks' => 12,
                'enrolled_count' => 41,
                'image' => 'https://cdn.pixabay.com/photo/2021/08/04/13/06/software-developer-6521720_1280.jpg',
                'is_published' => true,
            ],
            [
                'title' => 'Data Structures & Algorithms - CS302',
                'slug' => 'data-structures-algorithms-cs302',
                'description' => 'Fundamental data structures and algorithm analysis. Arrays, linked lists, trees, graphs, sorting, and searching algorithms.',
                'instructor' => null,
                'enrollment_key' => 'DSA2025',
                'category' => 'Computer Science',
                'semester' => 'Fall 2025',
                'language' => 'English',
                'skill_level' => 'Intermediate',
                'lessons' => 16,
                'duration_weeks' => 14,
                'enrolled_count' => 58,
                'image' => 'https://cdn.pixabay.com/photo/2019/05/17/04/35/technology-4208293_1280.jpg',
                'is_published' => true,
            ],
            [
                'title' => 'Network Security - CS404',
                'slug' => 'network-security-cs404',
                'description' => 'Comprehensive study of network security principles, cryptography, and cybersecurity practices for modern systems.',
                'instructor' => null,
                'enrollment_key' => 'NETSEC2025',
                'category' => 'Cyber Security',
                'semester' => 'Fall 2025',
                'language' => 'English',
                'skill_level' => 'Advanced',
                'lessons' => 12,
                'duration_weeks' => 10,
                'enrolled_count' => 33,
                'image' => 'https://cdn.pixabay.com/photo/2016/11/19/15/32/code-1839877_1280.jpg',
                'is_published' => true,
            ],
            [
                'title' => 'Research Methodology - GEN201',
                'slug' => 'research-methodology-gen201',
                'description' => 'Academic research techniques, paper writing, and presentation skills essential for university-level projects and thesis work.',
                'instructor' => null,
                'enrollment_key' => 'RESEARCH2025',
                'category' => 'General Education',
                'semester' => 'Fall 2025',
                'language' => 'English',
                'skill_level' => 'Beginner',
                'lessons' => 10,
                'duration_weeks' => 8,
                'enrolled_count' => 72,
                'image' => 'https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849822_1280.jpg',
                'is_published' => true,
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}