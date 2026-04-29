<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f8ff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Updated Header to Match Teacher Dashboard Pattern */
        .header {
            background-color: white;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .header-top {
            background-color: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            padding: 8px 30px;
        }

        .header-bottom {
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-container {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 10px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background-color: #e0f2fe;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0369a1;
        }

        .logo-text {
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
        }

        .system-name {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-right: 20px;
        }

        .system-logo {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .system-name a {
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            color: #333;
            transition: color 0.3s;
        }

        .system-name a:hover {
            color: #0369a1;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
            padding: 5px 0;
            position: relative;
        }

        .nav-links a:hover {
            color: #0369a1;
        }

        .nav-links a.active {
            color: #0369a1;
            font-weight: bold;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #0369a1;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-bar {
            position: relative;
            margin-right: 15px;
        }

        .search-bar input {
            padding: 6px 12px 6px 30px;
            border: 1px solid #ddd;
            border-radius: 18px;
            width: 200px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #0369a1;
            box-shadow: 0 0 0 2px rgba(3, 105, 161, 0.1);
            width: 240px;
        }

        .search-bar i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 0.9rem;
        }

        .notification-icon, .profile-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
        }

        .notification-icon {
            background-color: #f5f5f5;
            color: #555;
        }

        .profile-icon {
            background-color: #e0e0e0;
            color: #555;
            position: relative;
        }

        .profile-dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            width: 180px;
            display: none;
            z-index: 101;
        }

        .profile-dropdown.active {
            display: block;
        }

        .profile-dropdown a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            text-decoration: none;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
        }

        .profile-dropdown a:last-child {
            border-bottom: none;
        }

        .profile-dropdown a:hover {
            background-color: #f5f5f5;
        }

        /* Top bar user info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.9rem;
            color: #666;
        }

        .user-info span {
            padding: 0 10px;
            border-right: 1px solid #ddd;
        }

        .user-info span:last-child {
            border-right: none;
        }

        /* Rest of the existing styles remain unchanged */
        /* Main Layout */
        .main-container {
            display: flex;
            flex: 1;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: #e6f2ff;
            width: 220px;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
        }

        .hamburger {
            padding: 10px 20px;
            font-size: 1.2rem;
            color: #555;
            cursor: pointer;
        }

        .sidebar-links {
            display: flex;
            flex-direction: column;
            padding: 20px 0;
        }

        .sidebar-links a {
            padding: 12px 25px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.3s;
        }

        .sidebar-links a:hover {
            background-color: #d4e9ff;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            background-color: #f0f8ff;
            transition: margin-left 0.3s ease;
        }

        .dashboard-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 25px;
            color: #333;
        }

        /* Statistics Section */
        .statistics-section {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .statistics-cards {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .stat-card {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background-color: #e8f5e9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4caf50;
            font-size: 1.5rem;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Courses Section */
        .courses-section {
            margin-top: 30px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .courses-carousel {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding-bottom: 15px;
            scrollbar-width: thin;
        }

        .courses-carousel::-webkit-scrollbar {
            height: 8px;
        }

        .courses-carousel::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 4px;
        }

        .course-card {
            min-width: 280px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            gap: 15px;
            transition: transform 0.3s, opacity 0.3s;
        }

        .course-card.hidden {
            display: none;
        }

        .course-card.highlight {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid #0369a1;
        }

        .thumbnail {
            height: 120px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }

        .thumbnail-placeholder {
            position: absolute;
            bottom: 10px;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .course-title {
            font-weight: bold;
            color: #333;
            font-size: 1rem;
            line-height: 1.4;
            height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .view-course-btn {
            background-color: #0369a1;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            align-self: center;
            margin-top: 5px;
        }

        .view-course-btn:hover {
            background-color: #0284c7;
        }

        .no-results {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
            display: none;
        }

        .no-results.show {
            display: block;
        }

        /* Calendar Section */
        .calendar-section {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-nav {
            display: flex;
            gap: 10px;
        }

        .calendar-nav button {
            background: none;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .calendar-nav button:hover {
            background-color: #f5f5f5;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background-color: #f0f0f0;
            border: 1px solid #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .calendar-day-header {
            background-color: #f8f9fa;
            padding: 12px 5px;
            text-align: center;
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
        }

        .calendar-day {
            background-color: white;
            padding: 10px 5px;
            min-height: 80px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .calendar-day:hover {
            background-color: #f8f9fa;
        }

        .calendar-day.other-month {
            color: #adb5bd;
            background-color: #f8f9fa;
        }

        .calendar-day.today {
            background-color: #e7f3ff;
            font-weight: bold;
        }

        .calendar-day.has-event::after {
            content: "";
            display: block;
            width: 6px;
            height: 6px;
            background-color: #0369a1;
            border-radius: 50%;
            margin: 5px auto 0;
        }

        .day-number {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        /* Loading Spinner */
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .loading.show {
            display: block;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #0369a1;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Footer */
        .footer {
            background: #1f2937;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
            font-size: 0.85rem;
        }

        /* Mobile menu button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .statistics-cards {
                flex-direction: column;
            }
            
            .sidebar {
                width: 70px;
            }
            
            .sidebar-links a span {
                display: none;
            }
            
            .calendar-grid {
                grid-template-columns: repeat(7, 1fr);
            }
            
            .calendar-day {
                min-height: 60px;
                padding: 5px 2px;
            }
            
            .nav-links {
                gap: 20px;
            }
            
            .search-bar input {
                width: 180px;
            }
            
            .search-bar input:focus {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .header-bottom {
                flex-wrap: wrap;
                padding: 10px 15px;
                justify-content: space-between;
            }

            .nav-container {
                order: 3;
                width: 100%;
                margin-top: 15px;
            }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .system-name {
                margin-right: 0;
                margin-bottom: 10px;
                padding-bottom: 10px;
                border-bottom: 1px solid #e5e7eb;
                width: 100%;
            }

            .nav-links.active {
                display: flex;
            }

            .logo-section {
                position: static;
                transform: none;
                order: 1;
            }

            .header-right {
                order: 2;
            }

            .mobile-menu-btn {
                display: block;
            }

            .search-bar input {
                width: 150px;
            }

            .search-bar input:focus {
                width: 180px;
            }

            .user-info {
                font-size: 0.8rem;
                gap: 8px;
            }

            .user-info span {
                padding: 0 5px;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .calendar-grid {
                grid-template-columns: repeat(7, 1fr);
            }
            
            .calendar-day {
                min-height: 50px;
                font-size: 0.8rem;
            }
            
            .calendar-day-header {
                font-size: 0.8rem;
                padding: 8px 2px;
            }
            
            .course-card {
                min-width: 250px;
            }
        }

        @media (max-width: 576px) {
            .header-top {
                padding: 8px 15px;
            }
            
            .logo-text {
                display: none;
            }
            
            .search-bar {
                display: none;
            }
            
            .sidebar {
                position: fixed;
                left: -220px;
                height: 100%;
                z-index: 99;
                transition: left 0.3s ease;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 98;
                display: none;
            }
            
            .overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Updated Header with Two-Row Pattern -->
    <header class="header">
        <div class="header-top">
            <div class="user-info justify-end flex">
                <span><i class="fas fa-user-circle mr-1"></i> {{ Auth::user()->name ?? 'Student' }}</span>
                <span><i class="fas fa-envelope mr-1"></i> {{ Auth::user()->email ?? 'student@example.com' }}</span>
                <span><i class="fas fa-graduation-cap mr-1"></i> Student</span>
            </div>
        </div>
        
        <div class="header-bottom">
            <!-- Navigation Links on Left -->
            <div class="nav-container">
                <nav>
                    <button class="mobile-menu-btn" id="mobile-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul class="nav-links" id="nav-links">
                        <!-- System Name with Logo and Home Link -->
                        <li class="system-name">
                            <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Digital E-Learning Logo" class="system-logo">
                            <a href="{{ url('/') }}">Digital E-Learning</a>
                        </li>
                        
                        <!-- Original Navigation Links -->
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('student.dashboard') }}" class="active">Dashboard</a></li>
                        <li><a href="{{ route('courses.index') }}">Courses</a></li>
                    </ul>
                </nav>
            </div>
            
            <!-- Student Portal Centered -->
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="logo-text">Student Portal</div>
            </div>
            
            <!-- Search, Notification, Profile on Right -->
            <div class="header-right">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Search courses...">
                </div>
                
                <div class="notification-icon">
                    <i class="fas fa-bell"></i>
                </div>
                
                <div class="profile-icon" id="profile-icon">
                    <i class="fas fa-user"></i>
                    <div class="profile-dropdown" id="profile-dropdown">
                        <a href="#"><i class="fas fa-user"></i> Profile</a>
                        <a href="#"><i class="fas fa-calendar"></i> Calendar</a>
                        <a href="#"><i class="fas fa-cog"></i> Settings</a>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt"></i> Log out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <!-- Overlay for mobile menu -->
    <div class="overlay" id="overlay"></div>
    
    <!-- Rest of the student dashboard body remains exactly the same -->
    <!-- Main Content Area -->
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
            <div class="sidebar-links">
                <a href="{{ route('student.courses') }}"><i class="fas fa-book"></i><span>All My Course</span></a>
                <a href="{{ route('student.events') }}"><i class="fas fa-calendar-alt"></i> <span>Upcoming events</span></a>
                <a href="{{ route('student.leaderboard')}}"><i class="fas fa-award"></i> <span>Leaderboard</span></a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <h1 class="dashboard-title">Dashboard</h1>
            
            <!-- Loading Spinner -->
            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p>Loading dashboard data...</p>
            </div>
            
            <!-- Statistics Section -->
            <div class="statistics-section" id="statistics-section">
                <div class="statistics-cards">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">{{ $statistics['enrolled_courses'] }}</div>
                            <div class="stat-label">Enrolled Courses</div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">{{ $statistics['completed_courses'] }}</div>
                            <div class="stat-label">Completed Courses</div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">{{ $statistics['completed_activities'] }}</div>
                            <div class="stat-label">Completed Activities</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recently Accessed Courses -->
            <div class="courses-section">
                <h2 class="section-title">Recently accessed courses</h2>
                
                <div class="courses-carousel" id="courses-container">
                    @foreach($recentCourses as $enrollment)
                    <div class="course-card" data-title="{{ $enrollment->course->title }}">
                        <div class="thumbnail" style="background-color: #{{ substr(md5($enrollment->course->title), 0, 6) }}20; color: #{{ substr(md5($enrollment->course->title), 0, 6) }};">
                            <div class="thumbnail-placeholder">{{ substr($enrollment->course->title, 0, 15) }}...</div>
                        </div>
                        <div class="course-title">{{ $enrollment->course->title }}</div>
                        <div class="course-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $enrollment->progress }}%"></div>
                            </div>
                            <span>{{ number_format($enrollment->progress, 0) }}% Complete</span>
                        </div>
                        <button class="view-course-btn" onclick="viewCourse({{ $enrollment->course->id }})">View Course</button>
                    </div>
                    @endforeach
                    
                    @if($recentCourses->isEmpty())
                    <div class="no-results show">
                        <i class="fas fa-book-open" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <p>You haven't enrolled in any courses yet.</p>
                        <p>Browse available courses to get started.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="calendar-section">
                <div class="calendar-header">
                    <h2 class="section-title">Calendar</h2>
                    <div class="calendar-nav">
                        <button id="prev-month"><i class="fas fa-chevron-left"></i></button>
                        <button id="next-month"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="calendar-grid" id="calendar">
                    <!-- Calendar will be generated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="max-w-7xl mx-auto px-4">
            <p>© {{ date('Y') }} Digital E-Learning Platform. All rights reserved.</p>
            <p class="text-gray-400 text-sm mt-2">Student Portal v1.0</p>
        </div>
    </footer>

    <script>
        // Update JavaScript to handle new header structure
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const navLinks = document.getElementById('nav-links');
            const overlay = document.getElementById('overlay');
            const profileIcon = document.getElementById('profile-icon');
            const profileDropdown = document.getElementById('profile-dropdown');

            // Toggle mobile menu
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    navLinks.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
            }

            // Close mobile menu when clicking overlay
            if (overlay) {
                overlay.addEventListener('click', function() {
                    navLinks.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }

            // Toggle profile dropdown
            if (profileIcon && profileDropdown) {
                profileIcon.addEventListener('click', function(e) {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('active');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!profileIcon.contains(event.target)) {
                        profileDropdown.classList.remove('active');
                    }
                });
            }

            // The rest of your existing JavaScript remains the same...
            // API endpoints
            const API_ENDPOINTS = {
                UPDATE_ACCESS: '{{ route("student.course.update-access", ":courseId") }}',
                CALENDAR_EVENTS: '{{ route("student.calendar-events") }}'
            };

            // Search functionality
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase().trim();
                    const courseCards = document.querySelectorAll('.course-card');
                    let hasVisibleResults = false;
                    
                    // Remove highlight from all cards first
                    courseCards.forEach(card => {
                        card.classList.remove('highlight');
                    });
                    
                    if (searchTerm === '') {
                        // Show all cards if search is empty
                        courseCards.forEach(card => {
                            card.classList.remove('hidden');
                        });
                        const noResults = document.querySelector('.no-results');
                        if (noResults) noResults.classList.remove('show');
                        return;
                    }
                    
                    // Filter courses based on search term
                    courseCards.forEach(card => {
                        const courseTitle = card.getAttribute('data-title').toLowerCase();
                        
                        if (courseTitle.includes(searchTerm)) {
                            card.classList.remove('hidden');
                            card.classList.add('highlight');
                            hasVisibleResults = true;
                        } else {
                            card.classList.add('hidden');
                        }
                    });
                    
                    // Show no results message if no matches found
                    const noResults = document.querySelector('.no-results');
                    if (noResults) {
                        if (hasVisibleResults) {
                            noResults.classList.remove('show');
                        } else {
                            noResults.classList.add('show');
                        }
                    }
                });
            }

            // View Course function
            window.viewCourse = function(courseId) {
                // Update last accessed time
                fetch(API_ENDPOINTS.UPDATE_ACCESS.replace(':courseId', courseId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                // Redirect to course page
                window.location.href = `/student/courses/${courseId}`;
            }

            // Calendar functionality (keep existing)
            const calendarElement = document.getElementById('calendar');
            const prevMonthBtn = document.getElementById('prev-month');
            const nextMonthBtn = document.getElementById('next-month');

            let currentDate = new Date();
            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();

            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

            // Events data from backend
            const eventsData = @json($upcomingEvents->map(function($event) {
                return [
                    'date' => $event->event_date->format('Y-m-d'),
                    'title' => $event->title,
                    'type' => $event->event_type
                ];
            }));

            // Convert events data to object for easy lookup
            const events = {};
            eventsData.forEach(event => {
                events[event.date] = event.title;
            });

            function renderCalendar() {
                // Update calendar header
                document.querySelector('.calendar-section .section-title').textContent = 
                    `${monthNames[currentMonth]} ${currentYear}`;

                // Clear previous calendar
                calendarElement.innerHTML = '';

                // Add day headers
                dayNames.forEach(day => {
                    const dayHeader = document.createElement('div');
                    dayHeader.className = 'calendar-day-header';
                    dayHeader.textContent = day;
                    calendarElement.appendChild(dayHeader);
                });

                // Get first day of month and total days
                const firstDay = new Date(currentYear, currentMonth, 1).getDay();
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
                const daysInPrevMonth = new Date(currentYear, currentMonth, 0).getDate();

                // Add days from previous month
                for (let i = firstDay - 1; i >= 0; i--) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day other-month';
                    dayElement.innerHTML = `<div class="day-number">${daysInPrevMonth - i}</div>`;
                    calendarElement.appendChild(dayElement);
                }

                // Add days from current month
                const today = new Date();
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day';
                    
                    // Check if it's today
                    if (day === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                        dayElement.classList.add('today');
                    }
                    
                    // Check if there's an event on this day
                    const dateString = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    if (events[dateString]) {
                        dayElement.classList.add('has-event');
                        dayElement.title = events[dateString];
                    }
                    
                    dayElement.innerHTML = `<div class="day-number">${day}</div>`;
                    calendarElement.appendChild(dayElement);
                }

                // Calculate how many days from next month to show
                const totalCells = 42; // 6 rows x 7 days
                const remainingCells = totalCells - (firstDay + daysInMonth);
                
                // Add days from next month
                for (let day = 1; day <= remainingCells; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day other-month';
                    dayElement.innerHTML = `<div class="day-number">${day}</div>`;
                    calendarElement.appendChild(dayElement);
                }
            }

            // Navigation buttons
            prevMonthBtn.addEventListener('click', () => {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                renderCalendar();
            });

            nextMonthBtn.addEventListener('click', () => {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                renderCalendar();
            });

            // Initialize the dashboard
            function initDashboard() {
                renderCalendar();
                // Hide loading spinner and show content
                const loadingElement = document.getElementById('loading');
                if (loadingElement) loadingElement.classList.remove('show');
                const statisticsSection = document.getElementById('statistics-section');
                if (statisticsSection) statisticsSection.style.display = 'block';
            }

            // Start the dashboard
            initDashboard();
        });
    </script>
</body>
</html>