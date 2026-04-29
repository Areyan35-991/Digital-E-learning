@extends('layouts.teacher')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">My Courses</h1>
                        <p class="text-gray-600">All courses assigned to you</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $courses->total() }} total courses
                    </div>
                </div>

                <!-- Courses Grid -->
                @if($courses->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h3>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $course->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $course->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ Str::limit($course->description, 100) }}
                                </p>
                                
                                <div class="space-y-2 text-sm text-gray-500 mb-4">
                                    <div class="flex justify-between">
                                        <span>
                                            <i class="fas fa-book-open mr-1"></i>
                                            {{ $course->lessons }} lessons
                                        </span>
                                        <span>
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $course->duration_weeks }} weeks
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>
                                            <i class="fas fa-users mr-1"></i>
                                            {{ $course->enrolled_count }} students
                                        </span>
                                        <span class="font-semibold text-blue-600">
                                            {{ $course->semester }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('teacher.courses.show', $course->id) }}" 
                                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md text-sm font-medium transition text-center">
                                        Manage
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $courses->links() }}
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                        <i class="fas fa-book text-gray-400 text-4xl mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Courses Assigned</h3>
                        <p class="text-gray-500">You haven't been assigned to any courses yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection