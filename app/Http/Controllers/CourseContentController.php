<?php

namespace App\Http\Controllers;

use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseContentController extends Controller
{
    /**
     * Display content for students
     */
    public function show(CourseContent $content)
    {
        // Check if content is published or user is the teacher
        if (!$content->is_published && $content->instructor_id !== auth()->id()) {
            abort(404, 'Content not found or not published yet.');
        }

        $relatedContents = CourseContent::where('course_id', $content->course_id)
            ->where('instructor_id', $content->instructor_id)
            ->where('is_published', true)
            ->where('id', '!=', $content->id)
            ->orderBy('order')
            ->get();

        return view('contents.show', compact('content', 'relatedContents'));
    }

    /**
     * Download content file
     */
    public function download(CourseContent $content)
    {
        if (!$content->is_published && $content->instructor_id !== auth()->id()) {
            abort(404, 'Content not found or not published yet.');
        }

        if (!$content->file_path) {
            abort(404, 'File not available.');
        }

        // Check file exists
        if (!Storage::disk('public')->exists($content->file_path)) {
            abort(404, 'File not found.');
        }

      /*   return Storage::disk('public')->download($content->file_path);*/
    }
}