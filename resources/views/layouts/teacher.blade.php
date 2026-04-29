<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Teacher Portal - Digital E-Learning')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Updated to match student dashboard styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
        }

        /* Header Styles - Matching Student Dashboard */
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
            background-color: #fee2e2;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc2626;
        }

        .logo-text {
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
        }

        .nav-container {
            display: flex;
            align-items: center;
            flex: 1;
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
            color: #dc2626;
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
            color: #dc2626;
        }

        .nav-links a.active {
            color: #dc2626;
            font-weight: bold;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #dc2626;
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
            border-color: #dc2626;
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.1);
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

        /* Keep existing calendar and modal styles */
        .calendar-day {
            min-height: 80px;
            cursor: pointer;
            transition: background-color 0.2s;
            position: relative;
            padding: 10px 5px;
        }

        .calendar-day:hover {
            background-color: #f8f9fa;
        }

        .calendar-day.other-month {
            color: #adb5bd;
            background-color: #f8f9fa;
        }

        .calendar-day.today {
            background-color: #fee2e2;
            font-weight: bold;
        }

        .calendar-day.has-event::after {
            content: "";
            display: block;
            width: 6px;
            height: 6px;
            background-color: #dc2626;
            border-radius: 50%;
            margin: 5px auto 0;
        }

        .day-number {
            font-size: 0.9rem;
            margin-bottom: 5px;
            font-weight: 500;
        }

        /* Event Modal Styles */
        .event-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            align-items: center;
            justify-content: center;
        }

        .event-modal.active {
            display: flex;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        /* Loading Spinner */
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #dc2626;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

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

        /* Responsive design */
        @media (max-width: 1024px) {
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
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Updated Header to Match Student Dashboard -->
        <header class="header">
            <div class="header-top">
                <div class="user-info justify-end flex">
                    <span><i class="fas fa-user-circle mr-1"></i> {{ Auth::user()->name }}</span>
                    <span><i class="fas fa-envelope mr-1"></i> {{ Auth::user()->email }}</span>
                    <span><i class="fas fa-briefcase mr-1"></i> Faculty Member</span>
                </div>
            </div>
            
            <div class="header-bottom">
                <!-- Navigation Links Moved to Left -->
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
                            <li><a href="{{ route('teacher.dashboard') }}" class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                            <li><a href="#" class="{{ request()->routeIs('teacher.courses.*') ? 'active' : '' }}">My Courses</a></li>
                            <li><a href="#calendar-section">Calendar</a></li>
                            <li><a href="{{ route('teacher.results.search') }}">Student Progress</a></li>

                        </ul>
                    </nav>
                </div>
                
                <!-- Teacher Portal Centered -->
                <div class="logo-section">
                    <div class="logo-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="logo-text">Teacher Portal</div>
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
                            <a href="#calendar-section"><i class="fas fa-calendar"></i> Calendar</a>
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
        
        <!-- Mobile Menu Overlay -->
        <div class="overlay" id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 99;"></div>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="max-w-7xl mx-auto px-4">
                <p>© {{ date('Y') }} Digital E-Learning Platform. All rights reserved.</p>
                <p class="text-gray-400 text-sm mt-2">Teacher Portal v1.0</p>
            </div>
        </footer>
    </div>

    <!-- Event Modal (Keep existing) -->
    <div class="event-modal" id="event-modal">
        <!-- ... existing modal content ... -->
    </div>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const navLinks = document.getElementById('nav-links');
            const overlay = document.getElementById('overlay');
            const profileIcon = document.getElementById('profile-icon');
            const profileDropdown = document.getElementById('profile-dropdown');

            // Toggle mobile menu
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    navLinks.classList.toggle('active');
                    overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
                });
            }

            // Close mobile menu when clicking overlay
            if (overlay) {
                overlay.addEventListener('click', function() {
                    navLinks.classList.remove('active');
                    overlay.style.display = 'none';
                });
            }

            // Toggle profile dropdown
            if (profileIcon && profileDropdown) {
                profileIcon.addEventListener('click', function(e) {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('active');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function() {
                    profileDropdown.classList.remove('active');
                });
            }

            // Search functionality
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    // Add search functionality here
                    console.log('Searching for:', this.value);
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>