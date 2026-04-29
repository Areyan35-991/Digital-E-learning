<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

// Student Course Routes
Route::middleware(['auth', 'student'])->prefix('student')->group(function () {
    // Course viewing
    Route::get('/courses/{id}', [CourseController::class, 'studentCourseShow'])
        ->name('student.courses.show');
    
    Route::get('/courses/{courseId}/content/{contentId}', [CourseController::class, 'studentContentShow'])
        ->name('student.courses.content.show');
    
    // Progress tracking
    Route::post('/courses/{courseId}/content/{contentId}/complete', [CourseController::class, 'markContentComplete'])
        ->name('student.courses.content.complete');
    
    Route::post('/courses/{courseId}/content/{contentId}/progress', [CourseController::class, 'updateProgress'])
        ->name('student.courses.content.progress');
    
    // Certificate
    Route::get('/courses/{id}/certificate', [CourseController::class, 'getCertificate'])
        ->name('student.courses.certificate');
    
    // Download materials
    Route::get('/courses/{courseId}/download/{attachmentId}', [CourseController::class, 'downloadMaterial'])
        ->name('student.courses.download');
});