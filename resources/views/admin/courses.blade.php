@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Academic Course Management</h1>
        <p class="text-gray-600">Manage all academic courses and teacher assignments</p>
    </div>
    <a href="{{ route('admin.courses.create') }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
        <i class="fas fa-plus mr-2"></i> Add New Course
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned Teacher</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrollment Key</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($courses as $course)
            <tr>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">{{ $course->title }}</div>
                    <div class="text-sm text-gray-500">{{ Str::limit($course->description, 60) }}</div>
                    <div class="text-xs text-gray-400 mt-1">
                        {{ $course->semester }} • {{ $course->lessons }} lessons
                    </div>
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($course->instructor_id)
                        <!-- Course has assigned teacher -->
                        <div class="text-sm text-gray-900">{{ $course->instructor }}</div>
            
                        <form action="{{ route('admin.courses.unassign', $course->id) }}" method="POST" class="mt-1">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-xs text-red-600 hover:text-red-800" 
                                    onclick="return confirm('Remove teacher assignment?')">
                                Unassign
                            </button>
                        </form>
                    @elseif($course->instructor)
                        <!-- Course has instructor name but no ID assignment -->
                        <div class="text-sm text-gray-900">{{ $course->instructor }}</div>
                        <div class="text-xs text-orange-500">Manual assignment</div>
                        <button onclick="openAssignmentModal({{ $course->id }}, '{{ $course->instructor }}')"
                                class="text-xs text-blue-600 hover:text-blue-800 mt-1">
                            Assign Properly
                        </button>
                    @else
                        <!-- No teacher assigned -->
                        <div class="text-sm text-gray-400">Not assigned</div>
                        <button onclick="openAssignmentModal({{ $course->id }})"
                                class="text-xs text-green-600 hover:text-green-800 mt-1">
                            Assign Teacher
                        </button>
                    @endif
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap">
                    <code class="text-sm font-mono text-blue-600 bg-blue-50 px-2 py-1 rounded">
                        {{ $course->enrollment_key }}
                    </code>
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $course->category }}</td>
                
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                    <span class="font-semibold">{{ $course->enrolled_count }}</span>
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $course->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $course->is_published ? 'Active' : 'Draft' }}
                    </span>
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.courses.show', $course->id) }}" 
                           class="text-blue-600 hover:text-blue-900" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.courses.edit', $course->id) }}" 
                           class="text-green-600 hover:text-green-900" title="Edit Course">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.courses.toggle-publish', $course->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-purple-600 hover:text-purple-900" 
                                    title="{{ $course->is_published ? 'Unpublish' : 'Publish' }}">
                                <i class="fas {{ $course->is_published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $courses->links() }}
    </div>
</div>

<!-- Teacher Assignment Modal -->
<div id="assignmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Assign Teacher to Course</h3>
            
            <form id="assignmentForm" method="POST">
                @csrf
                <input type="hidden" name="course_id" id="courseId">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Teacher</label>
                    <select name="instructor_id" id="teacherSelect" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Choose a teacher...</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">
                                {{ $teacher->name }} ({{ $teacher->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Or Enter Teacher Name</label>
                    <input type="text" name="instructor_name" id="instructorName"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Enter teacher name manually">
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAssignmentModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Assign Teacher
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAssignmentModal(courseId, currentInstructor = '') {
    document.getElementById('courseId').value = courseId;
    document.getElementById('instructorName').value = currentInstructor;
    
    // Fix: Use proper route with course ID
    const form = document.getElementById('assignmentForm');
    form.action = "{{ route('admin.courses.assign', ':courseId') }}".replace(':courseId', courseId);
    
    document.getElementById('assignmentModal').classList.remove('hidden');
}

function closeAssignmentModal() {
    document.getElementById('assignmentModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('assignmentModal').addEventListener('click', function(e) {
    if (e.target.id === 'assignmentModal') {
        closeAssignmentModal();
    }
});
</script>
@endsection