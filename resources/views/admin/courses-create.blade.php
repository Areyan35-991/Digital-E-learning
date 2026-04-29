@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Create New Course</h1>
    
    <form action="{{ route('admin.courses.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Course Basic Info -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Course Title *</label>
                <input type="text" name="title" required value="{{ old('title') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
                <input type="text" name="slug" required value="{{ old('slug') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g., database-systems-cs401">
                <p class="text-sm text-gray-500 mt-1">URL-friendly version (no spaces, lowercase)</p>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea name="description" rows="4" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>
            
            <!-- Instructor & Enrollment -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Instructor Name</label>
                <input type="text" name="instructor" value="{{ old('instructor') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Optional - can assign later">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Enrollment Key *</label>
                <input type="text" name="enrollment_key" required value="{{ old('enrollment_key') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g., DBSYSTEMS2025">
            </div>
            
            <!-- Course Details -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                <input type="text" name="category" required value="{{ old('category') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g., Computer Science">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Semester *</label>
                <input type="text" name="semester" required value="{{ old('semester') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g., Fall 2025">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Language *</label>
                <input type="text" name="language" required value="{{ old('language') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g., English">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Skill Level *</label>
                <select name="skill_level" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Level</option>
                    <option value="Beginner" {{ old('skill_level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="Intermediate" {{ old('skill_level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="Advanced" {{ old('skill_level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Number of Lessons *</label>
                <input type="number" name="lessons" required value="{{ old('lessons') }}" min="1"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Duration (Weeks) *</label>
                <input type="number" name="duration_weeks" required value="{{ old('duration_weeks') }}" min="1"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <!-- Optional Fields -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Course Image URL (Optional)</label>
                <input type="url" name="image" value="{{ old('image') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="https://example.com/image.jpg">
            </div>
            
            <!-- Publish Option -->
            <div class="md:col-span-2">
                <div class="flex items-center">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_published" class="ml-2 block text-sm text-gray-900">
                        Publish course immediately
                    </label>
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.courses') }}" 
                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" 
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                Create Course
            </button>
        </div>
    </form>
</div>
@endsection