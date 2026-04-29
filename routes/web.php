<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherCourseController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    
    $user = Auth::user();
    
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } 
    elseif ($user->role === 'teacher') {
        return redirect()->route('teacher.dashboard');
    } 
    else {
        return redirect()->route('student.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Public courses page - accessible to everyone
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// Admin Authentication Routes (MUST be outside auth middleware)
Route::prefix('admin')->group(function () {
    Route::get('auth/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('auth/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('auth/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

// Profile routes (for all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Protected Routes
Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('admin.users.show');
    Route::put('/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.role');
    
    // Course Management
    Route::get('/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('/courses/create', [AdminController::class, 'createCourse'])->name('admin.courses.create');
    Route::post('/courses', [AdminController::class, 'storeCourse'])->name('admin.courses.store');
    Route::get('/courses/{id}', [AdminController::class, 'showCourse'])->name('admin.courses.show');
    Route::get('/courses/{id}/edit', [AdminController::class, 'editCourse'])->name('admin.courses.edit');
    Route::put('/courses/{id}', [AdminController::class, 'updateCourse'])->name('admin.courses.update');
    Route::delete('/courses/{id}', [AdminController::class, 'destroyCourse'])->name('admin.courses.destroy');
    Route::post('/courses/{course}/assign', [AdminController::class, 'assignCourse'])->name('admin.courses.assign');
    Route::put('/courses/{course}/unassign', [AdminController::class, 'unassignTeacher'])->name('admin.courses.unassign');
    Route::post('/courses/{id}/toggle-publish', [AdminController::class, 'toggleCoursePublish'])->name('admin.courses.toggle-publish');
    
    // Teacher Management
    Route::get('/teachers', [AdminController::class, 'teachers'])->name('admin.teachers');
    Route::get('/teachers/create', [AdminController::class, 'createTeacher'])->name('admin.teachers.create');
    Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('admin.teachers.store');
    Route::get('/teachers/{id}', [AdminController::class, 'showTeacher'])->name('admin.teachers.show');
    Route::get('/teachers/{id}/edit', [AdminController::class, 'editTeacher'])->name('admin.teachers.edit');
    Route::put('/teachers/{id}', [AdminController::class, 'updateTeacher'])->name('admin.teachers.update');
    Route::delete('/teachers/{id}', [AdminController::class, 'destroyTeacher'])->name('admin.teachers.destroy');
    
    // Bulk Assignment
    Route::get('/bulk-assignment', [AdminController::class, 'showBulkAssignment'])->name('admin.bulk-assignment');
    Route::post('/bulk-assignment', [AdminController::class, 'bulkAssignTeachers'])->name('admin.bulk-assignment.process');
});

// Teacher routes
Route::middleware(['auth'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherCourseController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/courses/{course}', [TeacherCourseController::class, 'showCourse'])->name('teacher.courses.show');
    Route::get('/courses/{course}/contents/create', [TeacherCourseController::class, 'createContent'])->name('teacher.contents.create');
    Route::post('/courses/{course}/contents', [TeacherCourseController::class, 'addContent'])->name('teacher.contents.store');
    Route::get('/contents/{content}/edit', [TeacherCourseController::class, 'editContent'])->name('teacher.contents.edit');
    Route::put('/contents/{content}', [TeacherCourseController::class, 'updateContent'])->name('teacher.contents.update');
    Route::delete('/contents/{content}', [TeacherCourseController::class, 'deleteContent'])->name('teacher.contents.destroy');
    Route::patch('/contents/{content}/toggle-publish', [TeacherCourseController::class, 'togglePublish'])->name('teacher.contents.toggle-publish');
    Route::post('/courses/{course}/reorder-contents', [TeacherCourseController::class, 'reorderContents'])->name('teacher.contents.reorder');
    Route::get('/calendar', [TeacherController::class, 'calendar'])->name('teacher.calendar');
    
    // Event routes
    Route::get('/events', [TeacherController::class, 'events'])->name('teacher.events');
    Route::post('/events', [TeacherController::class, 'storeEvent'])->name('teacher.events.store');
    Route::put('/events/{id}', [TeacherController::class, 'updateEvent'])->name('teacher.events.update');
    Route::delete('/events/{id}', [TeacherController::class, 'destroyEvent'])->name('teacher.events.destroy');
    Route::get('/events/list', [TeacherController::class, 'listEvents'])->name('teacher.events.list');
});

// Debug routes for teacher dashboard
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function() {
    Route::get('/debug/assignments', [TeacherController::class, 'debugAssignments']);
    Route::get('/refresh-data', [TeacherController::class, 'refreshTeacherData']);
});

// Course routes
Route::get('/course/{id}', [CourseController::class, 'show'])->name('course.show');
Route::post('/course/{id}/enroll', [CourseController::class, 'enroll'])->name('enroll')->middleware('auth');
Route::post('/course/{id}/enroll-with-key', [CourseController::class, 'enrollWithKey'])->name('enroll.with-key')->middleware('auth');
Route::get('/course/{id}/learn', [CourseController::class, 'learn'])->name('course.learn')->middleware('auth');

// Course enrollment route
Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])
    ->name('courses.enroll')
    ->middleware('auth');

// Course routes
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');

// Student course routes
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function() {
    Route::get('/courses', [CourseController::class, 'myCourses'])->name('student.courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'studentCourseShow'])->name('student.courses.show');
    Route::post('/courses/{course}/progress', [CourseController::class, 'updateProgress']);
    Route::delete('/courses/{course}/unenroll', [CourseController::class, 'unenroll'])->name('student.courses.unenroll');
});

// Teacher/Admin analytics
Route::middleware(['auth', 'role:teacher,admin'])->group(function() {
    Route::get('/courses/{course}/analytics', [CourseController::class, 'enrollmentAnalytics'])->name('courses.analytics');
});

// Teacher routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function() {
    // Course Management
    Route::get('/courses/{course}/manage', [TeacherController::class, 'manageCourse'])->name('teacher.courses.manage');
    
    // Modules
    Route::post('/courses/{course}/modules', [TeacherController::class, 'createModule'])->name('teacher.modules.create');
    Route::put('/courses/{course}/modules/{module}', [TeacherController::class, 'updateModule'])->name('teacher.modules.update');
    Route::delete('/courses/{course}/modules/{module}', [TeacherController::class, 'deleteModule'])->name('teacher.modules.delete');
    
    // Lessons
    Route::post('/courses/{course}/modules/{module}/lessons', [TeacherController::class, 'createLesson'])->name('teacher.lessons.create');
    Route::put('/courses/{course}/modules/{module}/lessons/{lesson}', [TeacherController::class, 'updateLesson'])->name('teacher.lessons.update');
    Route::delete('/courses/{course}/modules/{module}/lessons/{lesson}', [TeacherController::class, 'deleteLesson'])->name('teacher.lessons.delete');
    
    // Assignments
    Route::post('/courses/{course}/assignments', [TeacherController::class, 'createAssignment'])->name('teacher.assignments.create');
    Route::put('/courses/{course}/assignments/{assignment}', [TeacherController::class, 'updateAssignment'])->name('teacher.assignments.update');
    Route::delete('/courses/{course}/assignments/{assignment}', [TeacherController::class, 'deleteAssignment'])->name('teacher.assignments.delete');
    
    // Submissions
    Route::get('/courses/{course}/assignments/{assignment}/submissions', [TeacherController::class, 'viewSubmissions'])->name('teacher.submissions.view');
    Route::post('/courses/{course}/assignments/{assignment}/submissions/{submission}/grade', [TeacherController::class, 'gradeSubmission'])->name('teacher.submissions.grade');
    
    // Progress & Settings
    Route::get('/courses/{course}/progress', [TeacherController::class, 'viewStudentProgress'])->name('teacher.courses.progress');
    Route::post('/courses/{course}/settings', [TeacherController::class, 'updateCourseSettings'])->name('teacher.courses.settings');
    Route::post('/courses/{course}/upload-image', [TeacherController::class, 'uploadCourseImage'])->name('teacher.courses.upload-image');
});

// Teacher result management routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function() {
    Route::get('/results/search', [TeacherController::class, 'resultsSearch'])->name('teacher.results.search');
    Route::get('/results/search/{studentId}', [TeacherController::class, 'searchStudentById']);
    Route::get('/results/search-by-name/{name}', [TeacherController::class, 'searchStudentByName']);
    Route::get('/results/suggestions/{query}', [TeacherController::class, 'getStudentSuggestions']);
    
    // Result management (if you want to add/update grades)
    Route::get('/courses/{course}/grades', [TeacherController::class, 'viewCourseGrades']);
});

// Consolidated Student routes - FIXED VERSION
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [StudentDashboardController::class, 'dashboard'])->name('dashboard');
    
    // Courses
    Route::get('/courses', [StudentDashboardController::class, 'myCourses'])->name('courses');
    
    // Leaderboard
    Route::get('/leaderboard', [StudentDashboardController::class, 'leaderboard'])->name('leaderboard');
    
    // Events
    Route::get('/events', [StudentDashboardController::class, 'events'])->name('events');
    
    // Course progress tracking
    Route::post('/course/{course}/update-access', [StudentDashboardController::class, 'updateLastAccessed'])->name('course.update-access');
    Route::get('/calendar-events', [StudentDashboardController::class, 'getCalendarEvents'])->name('calendar-events');
});

// Student Course Routes
Route::middleware(['auth'])->prefix('student')->group(function () {
    // Course viewing
    Route::get('/courses/{id}', [CourseController::class, 'studentCourseShow'])
        ->name('student.courses.index');
    
    Route::get('/courses/{courseId}/content/{contentId}', [CourseController::class, 'studentContentShow'])
        ->name('student.courses.content.show');
    
    // Progress tracking
    Route::post('/courses/{courseId}/content/{contentId}/complete', [CourseController::class, 'markContentComplete'])
        ->name('student.courses.content.complete');
    
    Route::post('/courses/{courseId}/content/{contentId}/progress', [CourseController::class, 'updateProgress'])
        ->name('student.courses.content.progress');
    
    // Download materials
    Route::get('/courses/{courseId}/download/{attachmentId}', [CourseController::class, 'downloadMaterial'])
        ->name('student.courses.download');
});

// General content routes (for students and teachers)
Route::middleware(['auth'])->group(function () {
    Route::get('/contents/{content}', [CourseContentController::class, 'show'])->name('contents.show');
    Route::get('/contents/{content}/download', [CourseContentController::class, 'download'])->name('contents.download');
});
// guidelines page
Route::get('/guidelines', function () {
    return view('guidelines');
});
require __DIR__.'/auth.php';