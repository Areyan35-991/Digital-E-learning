@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Course Details</h1>
            <p class="text-gray-600">{{ $course->title }}</p>
        </div>
        <a href="{{ route('admin.courses') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            Back to Courses
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Course Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-700">Basic Info</h3>
                    <dl class="mt-2 space-y-2">
                        <div>
                            <dt class="text-sm text-gray-500">Title</dt>
                            <dd class="text-sm text-gray-900">{{ $course->title }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Description</dt>
                            <dd class="text-sm text-gray-900">{{ $course->description }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Category</dt>
                            <dd class="text-sm text-gray-900">{{ $course->category }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Semester</dt>
                            <dd class="text-sm text-gray-900">{{ $course->semester }}</dd>
                        </div>
                    </dl>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-700">Course Details</h3>
                    <dl class="mt-2 space-y-2">
                        <div>
                            <dt class="text-sm text-gray-500">Enrollment Key</dt>
                            <dd class="text-sm font-mono text-blue-600">{{ $course->enrollment_key }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Skill Level</dt>
                            <dd class="text-sm text-gray-900">{{ $course->skill_level }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Lessons & Duration</dt>
                            <dd class="text-sm text-gray-900">{{ $course->lessons }} lessons • {{ $course->duration_weeks }} weeks</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Enrolled Students</dt>
                            <dd class="text-sm text-gray-900">{{ $course->enrolled_count }} students</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Teacher Assignment Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">Teacher Assignment</h2>
        </div>
        
        <div class="p-6">
            @if($course->instructor_id)
                <!-- Currently assigned teacher -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-green-800 mb-2">Currently Assigned Teacher</h3>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-medium text-gray-900">{{ $course->instructor }}</p>
                            <p class="text-sm text-gray-600">Properly assigned via teacher account</p>
                        </div>
                        <form action="{{ route('admin.courses.unassign', $course->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm"
                                    onclick="return confirm('Remove this teacher assignment?')">
                                Unassign
                            </button>
                        </form>
                    </div>
                </div>
            @elseif($course->instructor)
                <!-- Manual assignment (name only) -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-yellow-800 mb-2">Manual Assignment</h3>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-medium text-gray-900">{{ $course->instructor }}</p>
                            
                        </div>
                        <form action="{{ route('admin.courses.unassign', $course->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm"
                                    onclick="return confirm('Remove this teacher assignment?')">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- No teacher assigned -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-gray-800 mb-2">No Teacher Assigned</h3>
                    <p class="text-gray-600">This course doesn't have an assigned teacher yet.</p>
                </div>
            @endif

            <!-- Assign Teacher Form -->
            <h3 class="font-semibold text-gray-700 mb-4">Assign New Teacher</h3>
            <form action="{{ route('admin.courses.assign', $course->id) }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select from Registered Teachers</label>
                    <select name="instructor_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Choose a teacher...</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" 
                                    {{ $course->instructor_id == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }} ({{ $teacher->email }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-sm text-gray-500 mt-1">This will link the course to the teacher's account</p>
                </div>
                
                <div class="text-center text-gray-500">OR</div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Enter Teacher Name Manually</label>
                    <input type="text" name="instructor_name" 
                           value="{{ $course->instructor }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Enter teacher name">
                    <p class="text-sm text-gray-500 mt-1">Use this for teachers not registered in the system</p>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                        Assign Teacher
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection