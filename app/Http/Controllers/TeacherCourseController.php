<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'teacher') {
                abort(403, 'Unauthorized access.');
            }
            return $next($request);
        });
    }

    /**
     * Teacher dashboard showing assigned courses
     */
  public function dashboard()
{
    $teacherId = auth()->id();
    
    $assignedCourses = auth()->user()->teachingCourses()
        ->withCount(['contents as teacher_contents_count' => function($query) use ($teacherId) {
            $query->where('instructor_id', $teacherId);
        }])
        ->wherePivot('is_active', true)
        ->get();

    // Calculate stats
    $totalStudents = $assignedCourses->sum('enrolled_count');
    $totalLessons = $assignedCourses->sum('teacher_contents_count');
    
    $recentContents = CourseContent::where('instructor_id', $teacherId)
        ->with('course')
        ->latest()
        ->take(5)
        ->get();

    return view('teacher.dashboard', compact(
        'assignedCourses', 
        'totalStudents', 
        'totalLessons', 
        'recentContents'
    ));
}

    /**
     * Show a specific course for teacher management
     */
     public function showCourse(Course $course)
    {
        // Check if teacher is assigned to this course
        if (!$course->teachers->contains(auth()->id())) {
            abort(403, 'You are not assigned to this course.');
        }

        $teacherId = auth()->id();
        // FIX: Use the correct method name
        $contents = $course->contents()
            ->where('instructor_id', $teacherId)
            ->orderBy('order')
            ->orderBy('created_at')
            ->get();

        $contentStats = [
            'total' => $contents->count(),
            'published' => $contents->where('is_published', true)->count(),
            'videos' => $contents->where('content_type', 'video')->count(),
            'pdfs' => $contents->where('content_type', 'pdf')->count(),
            'quizzes' => $contents->where('content_type', 'quiz')->count(),
        ];

        return view('teacher.courses.show', compact('course', 'contents', 'contentStats'));
    }

    /**
     * Show form to add new content
     */
    
    public function createContent(Course $course)
    {
        if (!$course->teachers->contains(auth()->id())) {
            abort(403, 'You are not assigned to this course.');
        }

        return view('teacher.contents.create', compact('course'));
    }

    /**
     * Store new course content
     */
    public function addContent(Request $request, Course $course)
    {
        if (!$course->teachers->contains(auth()->id())) {
            abort(403, 'You are not assigned to this course.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:video,pdf,quiz,assignment,text',
            'file' => 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,ppt,pptx|max:51200',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'external_url' => 'nullable|url',
            'is_published' => 'boolean'
        ]);

        try {
            $filePath = null;
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store("courses/{$course->id}/contents", 'public');
            }

            $content = CourseContent::create([
                'course_id' => $course->id,
                'instructor_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'content_type' => $request->content_type,
                'file_path' => $filePath,
                'external_url' => $request->external_url,
                'order' => $request->order ?? 0,
                'is_published' => $request->boolean('is_published', false)
            ]);

            return redirect()->route('teacher.courses.show', $course)
                ->with('success', 'Content added successfully!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add content: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show form to edit content
     */
    public function editContent(CourseContent $content)
    {
        if ($content->teacher_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('teacher.contents.edit', compact('content'));
    }

    /**
     * Update course content
     */
    public function updateContent(Request $request, CourseContent $content)
    {
        if ($content->instructor_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:video,pdf,quiz,assignment,text',
            'file' => 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,ppt,pptx|max:51200',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'external_url' => 'nullable|url',
            'is_published' => 'boolean'
        ]);

        try {
            $updateData = [
                'title' => $request->title,
                'description' => $request->description,
                'content_type' => $request->content_type,
                'external_url' => $request->external_url,
                'order' => $request->order ?? $content->order,
                'is_published' => $request->boolean('is_published', $content->is_published)
            ];

            if ($request->hasFile('file')) {
                // Delete old file if exists
                if ($content->file_path) {
                    Storage::disk('public')->delete($content->file_path);
                }
                
                $updateData['file_path'] = $request->file('file')
                    ->store("courses/{$content->course_id}/contents", 'public');
            }

            $content->update($updateData);

            return redirect()->route('teacher.courses.show', $content->course)
                ->with('success', 'Content updated successfully!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update content: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete course content
     */
     public function deleteContent(CourseContent $content)
    {
        // FIX: Changed 'instuctor_id' to 'instructor_id'
        if ($content->instructor_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // Delete associated file
            if ($content->file_path) {
                Storage::disk('public')->delete($content->file_path);
            }

            $courseId = $content->course_id;
            $content->delete();

            return redirect()->route('teacher.courses.show', $courseId)
                ->with('success', 'Content deleted successfully!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete content: ' . $e->getMessage());
        }
    }
    /**
     * Toggle content publish status
     */
    public function togglePublish(CourseContent $content)
    {
        if ($content->instructor_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $content->update([
            'is_published' => !$content->is_published
        ]);

        $status = $content->is_published ? 'published' : 'unpublished';
        
        return redirect()->back()
            ->with('success', "Content {$status} successfully!");
    }

    /**
     * Reorder contents
     */
    public function reorderContents(Request $request, Course $course)
    {
        if (!$course->teachers->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|exists:course_contents,id',
            'order.*.position' => 'required|integer'
        ]);

        try {
            foreach ($request->order as $item) {
                CourseContent::where('id', $item['id'])
                    ->where('instructor_id', auth()->id())
                    ->update(['order' => $item['position']]);
            }

            return response()->json(['success' => true, 'message' => 'Content order updated!']);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update order'], 500);
        }
    }
}