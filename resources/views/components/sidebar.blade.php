<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 bg-blue-600">
        <h1 class="text-white text-xl font-bold">BLC Learning</h1>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="mt-6">
        @php
            $currentRoute = request()->route()->getName();
        @endphp
        
        <!-- Student Menu -->
        @if(auth()->user()->role === 'student')
        <div class="px-4 space-y-2">
            <a href="{{ route('student.dashboard') }}" 
               class="flex items-center px-4 py-2 text-gray-700 {{ str_contains($currentRoute, 'student.dashboard') ? 'bg-blue-50 border-r-4 border-blue-600' : 'hover:bg-gray-100' }} rounded-lg">
                <i class="fas fa-home mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('student.courses.index') }}" 
               class="flex items-center px-4 py-2 text-gray-700 {{ str_contains($currentRoute, 'student.courses') ? 'bg-blue-50 border-r-4 border-blue-600' : 'hover:bg-gray-100' }} rounded-lg">
                <i class="fas fa-book mr-3"></i>
                My Courses
            </a>
        
        @endif
        
        <!-- Teacher Menu -->
        @if(auth()->user()->role === 'teacher')
        <div class="px-4 space-y-2">
            <a href="{{ route('teacher.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-home mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('teacher.courses.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-book mr-3"></i>
                Manage Courses
            </a>
            <a href="{{ route('teacher.students.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-users mr-3"></i>
                Students
            </a>
        </div>
        @endif
    </nav>
</aside>