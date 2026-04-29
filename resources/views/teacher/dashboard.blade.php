@extends('layouts.teacher')

@section('title', 'Teacher Dashboard - Digital E-Learning')

@section('content')
<div class="flex">
  

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Loading Spinner -->
        <div class="loading hidden mb-4 text-center" id="loading">
            <div class="spinner"></div>
            <p class="mt-2 text-gray-600">Loading dashboard data...</p>
        </div>
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white">
                <!-- Teacher Header -->
                <div class="flex justify-between items-center mb-8 pb-6 border-b border-gray-200">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Teacher Dashboard</h1>
                        <p class="text-gray-600">Welcome back, <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>!</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- User Info in Header -->
                        <div class="text-right bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Faculty Member</p>
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->email }}</p>
                        </div>
                        <!-- Additional Options -->
                        <div class="flex items-center space-x-2">
                            
                            <a href="#" 
                               class="p-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg">
                                <i class="fas fa-envelope text-lg"></i>
                            </a>
                           
                        </div>
                    </div>
                </div>

                <!-- Teacher Stats (Main Cards) -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-blue-50 rounded-lg p-6 border border-blue-200 hover:shadow-md transition">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-500 rounded-lg">
                                <i class="fas fa-book text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $assignedCourses->count() }}</h3>
                                <p class="text-gray-600">Assigned Courses</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 rounded-lg p-6 border border-green-200 hover:shadow-md transition">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-500 rounded-lg">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $totalStudents ?? 0 }}</h3>
                                <p class="text-gray-600">Total Students</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-purple-50 rounded-lg p-6 border border-purple-200 hover:shadow-md transition">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-500 rounded-lg">
                                <i class="fas fa-chalkboard text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $totalLessons ?? 0 }}</h3>
                                <p class="text-gray-600">Total Lessons</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-red-50 rounded-lg p-6 border border-red-200 hover:shadow-md transition">
                        <div class="flex items-center">
                            <div class="p-3 bg-red-500 rounded-lg">
                                <i class="fas fa-calendar-alt text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-800" id="upcoming-events-count">{{ count($events ?? []) }}</h3>
                                <p class="text-gray-600">Upcoming Events</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Courses Section -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">My Courses</h2>
                        <span class="text-sm text-gray-500">Recently Assigned</span>
                    </div>

                    @if($assignedCourses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($assignedCourses->take(6) as $course)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h3>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $course->skill_level == 'Beginner' ? 'bg-green-100 text-green-800' : 
                                               ($course->skill_level == 'Intermediate' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                            {{ $course->skill_level }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-gray-600 text-sm mb-4">
                                        {{ Str::limit($course->description, 100) }}
                                    </p>
                                    
                                    <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                                        <span>
                                            <i class="fas fa-book-open mr-1"></i>
                                            {{ $course->lessons ?? 0 }} lessons
                                        </span>
                                        <span>
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $course->duration_weeks ?? 0 }} weeks
                                        </span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">
                                            <i class="fas fa-users mr-1"></i>
                                            {{ $course->enrolled_count ?? 0 }} students
                                        </span>
                                        <span class="text-sm font-semibold text-blue-600">
                                            {{ $course->semester ?? 'N/A' }}
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <a href="{{ route('teacher.courses.show', $course->id) }}" 
                                           class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md text-sm font-medium transition text-center block">
                                            Manage Course
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($assignedCourses->count() > 6)
                            <div class="mt-6 text-center">
                                <a href="{{ route('teacher.courses.index') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    View All Courses
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                            <i class="fas fa-book text-gray-400 text-4xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Courses Assigned</h3>
                            <p class="text-gray-500 mb-4">You haven't been assigned to any courses yet.</p>
                            <p class="text-sm text-gray-400">Contact administrator to get assigned to courses.</p>
                        </div>
                    @endif
                </div>

                <!-- Recent Content Section -->
                @if(isset($recentContents) && $recentContents->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recently Added Content</h3>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($recentContents as $content)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $content->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $content->course->title ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $content->content_type == 'video' ? 'bg-red-100 text-red-800' : 
                                                   ($content->content_type == 'pdf' ? 'bg-blue-100 text-blue-800' : 
                                                   ($content->content_type == 'quiz' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}">
                                                {{ ucfirst($content->content_type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $content->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $content->is_published ? 'Published' : 'Draft' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $content->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Calendar Section -->
                <div id="calendar-section" class="mt-8">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-6">
                            <div class="calendar-header flex justify-between items-center mb-6">
                                <h2 class="section-title text-2xl font-bold text-gray-800">Calendar</h2>
                                <div class="calendar-nav flex space-x-2">
                                    <button id="prev-month" class="px-3 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button id="today-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                        Today
                                    </button>
                                    <button id="next-month" class="px-3 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                    <button id="add-event-btn" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 ml-2">
                                        <i class="fas fa-plus mr-2"></i> Add Event
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-4 text-center">
                                <h3 id="current-month" class="text-xl font-semibold text-gray-800"></h3>
                            </div>
                            
                            <div class="calendar-grid grid grid-cols-7 gap-1 bg-gray-100 border border-gray-200 rounded-lg overflow-hidden" id="calendar">
                                <!-- Calendar will be generated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@push('scripts')
<script>
    // API endpoints for teacher - USING SIMPLE ROUTES FOR NOW
    const API_ENDPOINTS = {
        EVENTS: {
            STORE: '{{ url("/teacher/events") }}',
            LIST: '{{ url("/teacher/events") }}',
        }
    };

    // Events data from backend - pass from controller
    const eventsData = @json($events ?? []);
    
    // Calendar state
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let selectedDate = null;
    let editingEvent = null;

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    // Group events by date for easy lookup
    const eventsByDate = {};
    eventsData.forEach(event => {
        const dateStr = event.date ? event.date.split(' ')[0] : new Date().toISOString().split('T')[0];
        if (!eventsByDate[dateStr]) {
            eventsByDate[dateStr] = [];
        }
        eventsByDate[dateStr].push(event);
    });

    // DOM elements
    const calendarElement = document.getElementById('calendar');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const todayBtn = document.getElementById('today-btn');
    const addEventBtn = document.getElementById('add-event-btn');
    const quickAddEvent = document.getElementById('quick-add-event');
    const loadingElement = document.getElementById('loading');

    // Initialize dashboard
    document.addEventListener('DOMContentLoaded', function() {
        setupEventListeners();
        renderCalendar();
        
        // Hide loading spinner
        if (loadingElement) {
            loadingElement.classList.add('hidden');
        }
    });

    // Setup event listeners
    function setupEventListeners() {
        // Calendar navigation
        if (prevMonthBtn) prevMonthBtn.addEventListener('click', goToPrevMonth);
        if (nextMonthBtn) nextMonthBtn.addEventListener('click', goToNextMonth);
        if (todayBtn) todayBtn.addEventListener('click', goToToday);
        
        // Add Event button
        if (addEventBtn) addEventBtn.addEventListener('click', function() {
            selectedDate = new Date().toISOString().split('T')[0]; // Today's date
            openAddEventModal();
        });
        
        // Quick action to scroll to calendar
        if (quickAddEvent) quickAddEvent.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('calendar-section').scrollIntoView({ behavior: 'smooth' });
        });
    }

    // Calendar functions
    function renderCalendar() {
        // Update calendar header
        const currentMonthElement = document.getElementById('current-month');
        if (currentMonthElement) {
            currentMonthElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;
        }

        // Clear previous calendar
        if (calendarElement) {
            calendarElement.innerHTML = '';
        } else {
            console.error('Calendar element not found');
            return;
        }

        // Add day headers
        dayNames.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.className = 'bg-gray-50 p-3 text-center font-semibold text-gray-700 text-sm';
            dayHeader.textContent = day;
            calendarElement.appendChild(dayHeader);
        });

        // Get first day of month and total days
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const daysInPrevMonth = new Date(currentYear, currentMonth, 0).getDate();

        // Add days from previous month
        for (let i = firstDay - 1; i >= 0; i--) {
            const day = daysInPrevMonth - i;
            const dayElement = createDayElement(day, true);
            calendarElement.appendChild(dayElement);
        }

        // Add days from current month
        const today = new Date();
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = createDayElement(day, false);
            
            // Check if it's today
            if (day === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                dayElement.classList.add('today', 'bg-blue-50', 'border-blue-200');
            }
            
            calendarElement.appendChild(dayElement);
        }

        // Calculate how many days from next month to show
        const totalCells = 42;
        const remainingCells = totalCells - (firstDay + daysInMonth);
        
        // Add days from next month
        for (let day = 1; day <= remainingCells; day++) {
            const dayElement = createDayElement(day, true);
            calendarElement.appendChild(dayElement);
        }

        // Add click events to days
        addDayClickEvents();
    }

    function createDayElement(day, isOtherMonth) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day bg-white p-2 min-h-24 border border-gray-100 hover:bg-gray-50 cursor-pointer transition';
        
        if (isOtherMonth) {
            dayElement.classList.add('other-month', 'text-gray-400');
        }
        
        const date = new Date(currentYear, isOtherMonth ? 
            (currentMonth === 0 ? 11 : currentMonth - 1) : currentMonth, 
            day);
        
        const dateStr = date.toISOString().split('T')[0];
        const eventsForDay = eventsByDate[dateStr] || [];
        
        // Day number
        const dayNumber = document.createElement('div');
        dayNumber.className = 'font-semibold text-right mb-1';
        dayNumber.textContent = day;
        dayElement.appendChild(dayNumber);
        
        // Add event indicator if there are events
        if (eventsForDay.length > 0) {
            dayElement.classList.add('has-event');
            
            // Create events list
            const eventsList = document.createElement('div');
            eventsList.className = 'space-y-1';
            
            eventsForDay.forEach(event => {
                const eventElement = document.createElement('div');
                eventElement.className = 'event-element text-xs p-1 rounded truncate cursor-pointer hover:opacity-80 ' + 
                    (event.type === 'class' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 
                     event.type === 'exam' ? 'bg-red-100 text-red-800 border border-red-200' : 
                     event.type === 'assignment' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : 
                     'bg-green-100 text-green-800 border border-green-200');
                eventElement.textContent = event.title || 'Event';
                eventElement.title = (event.title || 'Event') + (event.description ? '\n' + event.description : '');
                
                // Add click event to edit
                eventElement.addEventListener('click', function(e) {
                    e.stopPropagation();
                    openEditEventModal(event.id, event);
                });
                
                eventsList.appendChild(eventElement);
            });
            
            dayElement.appendChild(eventsList);
        }
        
        dayElement.dataset.date = dateStr;
        
        return dayElement;
    }

    function addDayClickEvents() {
        document.querySelectorAll('.calendar-day').forEach(day => {
            day.addEventListener('click', function(e) {
                // Don't trigger if clicking on an event element
                if (e.target.classList.contains('event-element') || 
                    e.target.closest('.event-element')) {
                    return;
                }
                
                selectedDate = this.dataset.date;
                openAddEventModal();
            });
        });
    }

    function goToPrevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar();
    }

    function goToNextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar();
    }

    function goToToday() {
        currentDate = new Date();
        currentMonth = currentDate.getMonth();
        currentYear = currentDate.getFullYear();
        renderCalendar();
    }

    // FIXED: Real modal implementation
    function openAddEventModal(eventId = null) {
        // Remove any existing modal first
        const existingModal = document.getElementById('eventModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Create modal HTML
        const modalHTML = `
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="eventModal">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            ${eventId ? 'Edit Event' : 'Add New Event'}
                        </h3>
                        
                        <form id="eventForm" class="space-y-4">
                            <input type="hidden" id="eventId" value="${eventId || ''}">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Event Date
                                </label>
                                <input type="date" id="eventDate" 
                                       value="${selectedDate || new Date().toISOString().split('T')[0]}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Event Title *
                                </label>
                                <input type="text" id="eventTitle" 
                                       placeholder="Enter event title" 
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Event Type
                                </label>
                                <select id="eventType" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    <option value="class">Class</option>
                                    <option value="exam">Exam</option>
                                    <option value="assignment">Assignment</option>
                                    <option value="meeting">Meeting</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Description
                                </label>
                                <textarea id="eventDescription" 
                                          rows="3"
                                          placeholder="Enter event description"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Start Time
                                    </label>
                                    <input type="time" id="eventStartTime" 
                                           value="09:00"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        End Time
                                    </label>
                                    <input type="time" id="eventEndTime" 
                                           value="10:00"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4 pt-4">
                                <button type="button" 
                                        onclick="closeEventModal()"
                                        class="flex-1 px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    ${eventId ? 'Update Event' : 'Save Event'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        
        // If editing, populate form with event data
        if (eventId && editingEvent) {
            document.getElementById('eventTitle').value = editingEvent.title || '';
            document.getElementById('eventType').value = editingEvent.type || 'class';
            document.getElementById('eventDescription').value = editingEvent.description || '';
            document.getElementById('eventDate').value = selectedDate || new Date().toISOString().split('T')[0];
            document.getElementById('eventStartTime').value = editingEvent.start_time || '09:00';
            document.getElementById('eventEndTime').value = editingEvent.end_time || '10:00';
        }
        
        // Add form submit handler
        document.getElementById('eventForm').addEventListener('submit', handleEventSubmit);
        
        // Close modal when clicking outside
        document.getElementById('eventModal').addEventListener('click', function(e) {
            if (e.target.id === 'eventModal') {
                closeEventModal();
            }
        });
    }
    
    function openEditEventModal(eventId, eventData) {
        editingEvent = eventData;
        selectedDate = eventData.date ? eventData.date.split(' ')[0] : new Date().toISOString().split('T')[0];
        openAddEventModal(eventId);
    }

    function closeEventModal() {
        const modal = document.getElementById('eventModal');
        if (modal) {
            modal.remove();
        }
        editingEvent = null;
    }

    async function handleEventSubmit(e) {
        e.preventDefault();
        
        const eventData = {
            date: document.getElementById('eventDate').value,
            title: document.getElementById('eventTitle').value,
            type: document.getElementById('eventType').value,
            description: document.getElementById('eventDescription').value,
            start_time: document.getElementById('eventStartTime').value,
            end_time: document.getElementById('eventEndTime').value,
            teacher_id: {{ Auth::id() }},
            _token: '{{ csrf_token() }}'
        };
        
        const eventId = document.getElementById('eventId').value;
        const isEditing = !!eventId;
        
        try {
            let response;
            if (isEditing) {
                // For now, we'll just show an alert since we don't have update endpoint
                alert('Edit functionality coming soon! For now, create a new event.');
                closeEventModal();
                return;
            } else {
                // Create new event
                response = await fetch(API_ENDPOINTS.EVENTS.STORE, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(eventData)
                });
            }
            
            if (response.ok) {
                const result = await response.json();
                alert(`Event ${isEditing ? 'updated' : 'added'} successfully!`);
                closeEventModal();
                
                // Add the new event to local events data
                const dateStr = eventData.date.split('T')[0];
                if (!eventsByDate[dateStr]) {
                    eventsByDate[dateStr] = [];
                }
                eventsByDate[dateStr].push({
                    id: result.id || Date.now(),
                    title: eventData.title,
                    type: eventData.type,
                    description: eventData.description,
                    date: eventData.date,
                    start_time: eventData.start_time,
                    end_time: eventData.end_time
                });
                
                // Update event count
                const eventCount = Object.values(eventsByDate).flat().length;
                document.getElementById('upcoming-events-count').textContent = eventCount;
                
                // Re-render calendar
                renderCalendar();
            } else {
                const error = await response.json();
                alert(`Error: ${error.message || 'Failed to save event'}`);
            }
        } catch (error) {
            console.error('Error saving event:', error);
            
            // Fallback: Simulate success for demo purposes
            alert('Event saved locally (demo mode). In production, this would save to database.');
            
            // Add to local storage for demo
            const dateStr = eventData.date.split('T')[0];
            if (!eventsByDate[dateStr]) {
                eventsByDate[dateStr] = [];
            }
            eventsByDate[dateStr].push({
                id: Date.now(),
                title: eventData.title,
                type: eventData.type,
                description: eventData.description,
                date: eventData.date,
                start_time: eventData.start_time,
                end_time: eventData.end_time
            });
            
            // Update event count
            const eventCount = Object.values(eventsByDate).flat().length;
            document.getElementById('upcoming-events-count').textContent = eventCount;
            
            // Re-render calendar
            renderCalendar();
            closeEventModal();
        }
    }
</script>
@endpush

<!-- Add some CSS for the sidebar and calendar -->
<style>
    @media (max-width: 768px) {
        .flex {
            flex-direction: column;
        }
        .w-64 {
            width: 100%;
        }
    }
    
    /* Calendar Styles */
    .calendar-day {
        min-height: 120px;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .calendar-day:hover {
        background-color: #f9fafb;
        transform: translateY(-1px);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .calendar-day.today {
        background-color: #eff6ff;
        border-color: #3b82f6;
        border-width: 2px;
    }
    
    .calendar-day.has-event {
        border-left: 3px solid #3b82f6;
    }
    
    .calendar-day.other-month {
        background-color: #f9fafb;
        color: #9ca3af;
    }
    
    /* Event items */
    .event-element {
        font-size: 0.75rem;
        padding: 2px 4px;
        margin-bottom: 2px;
        border-radius: 3px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    
    .event-element:hover {
        opacity: 0.8;
    }
    
    /* Loading spinner */
    .loading .spinner {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Calendar grid */
    .calendar-grid {
        min-height: 500px;
    }
</style>
@endsection