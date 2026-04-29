<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events - Student Portal</title>
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

        /* Events Page Styles */
        .events-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .events-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .events-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .events-filters {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .filter-dropdown {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white;
            cursor: pointer;
            font-size: 0.9rem;
            min-width: 150px;
        }

        .filter-dropdown:focus {
            outline: none;
            border-color: #0369a1;
        }

        .view-toggle {
            display: flex;
            gap: 5px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .view-toggle-btn {
            padding: 8px 15px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .view-toggle-btn.active {
            background-color: #0369a1;
            color: white;
        }

        .view-toggle-btn:hover:not(.active) {
            background-color: #f5f5f5;
        }

        /* Events Summary Cards */
        .events-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-top: 4px solid;
        }

        .summary-card.upcoming {
            border-top-color: #36a1d6;
        }

        .summary-card.quiz {
            border-top-color: #4caf50;
        }

        .summary-card.assignment {
            border-top-color: #ff9800;
        }

        .summary-card.submission {
            border-top-color: #9c27b0;
        }

        .summary-value {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .summary-label {
            color: #666;
            font-size: 0.9rem;
        }

        .summary-icon {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .summary-card.upcoming .summary-icon {
            color: #36a1d6;
        }

        .summary-card.quiz .summary-icon {
            color: #4caf50;
        }

        .summary-card.assignment .summary-icon {
            color: #ff9800;
        }

        .summary-card.submission .summary-icon {
            color: #9c27b0;
        }

        /* Events Timeline */
        .events-timeline {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .timeline-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
        }

        .timeline-controls {
            display: flex;
            gap: 10px;
        }

        .timeline-controls button {
            padding: 8px 15px;
            border: 1px solid #ddd;
            background: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .timeline-controls button:hover {
            background-color: #f5f5f5;
            border-color: #0369a1;
        }

        /* Timeline Items */
        .timeline-items {
            position: relative;
            padding-left: 30px;
        }

        .timeline-items::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e5e7eb;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 25px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s;
        }

        .timeline-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: #0369a1;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -36px;
            top: 25px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: white;
            border: 3px solid;
            z-index: 2;
        }

        .timeline-item.quiz::before {
            border-color: #4caf50;
        }

        .timeline-item.assignment::before {
            border-color: #ff9800;
        }

        .timeline-item.presentation::before {
            border-color: #36a1d6;
        }

        .timeline-item.project::before {
            border-color: #9c27b0;
        }

        .timeline-item.exam::before {
            border-color: #f44336;
        }

        .timeline-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .event-type {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .event-type-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .timeline-item.quiz .event-type-icon {
            background-color: #4caf50;
        }

        .timeline-item.assignment .event-type-icon {
            background-color: #ff9800;
        }

        .timeline-item.presentation .event-type-icon {
            background-color: #36a1d6;
        }

        .timeline-item.project .event-type-icon {
            background-color: #9c27b0;
        }

        .timeline-item.exam .event-type-icon {
            background-color: #f44336;
        }

        .event-type-label {
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .event-date {
            text-align: right;
        }

        .event-day {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .event-month {
            font-size: 0.9rem;
            color: #666;
        }

        .event-time {
            font-size: 0.85rem;
            color: #777;
            margin-top: 5px;
        }

        .event-content {
            margin-bottom: 15px;
        }

        .event-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .event-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .event-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            color: #666;
        }

        .meta-item i {
            color: #0369a1;
        }

        .event-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .event-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .event-btn.primary {
            background-color: #0369a1;
            color: white;
        }

        .event-btn.primary:hover {
            background-color: #0284c7;
        }

        .event-btn.secondary {
            background-color: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
        }

        .event-btn.secondary:hover {
            background-color: #e5e5e5;
        }

        .event-btn.danger {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .event-btn.danger:hover {
            background-color: #fee2e2;
        }

        /* Upcoming Events Grid */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .event-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .event-card-header {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .event-card-type {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .event-card-date {
            text-align: right;
        }

        .event-card-content {
            padding: 20px;
        }

        .event-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .event-card-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .event-card-meta {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 15px;
        }

        .event-card-footer {
            padding: 15px 20px;
            background-color: #f8fafc;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .event-status {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            padding: 4px 10px;
            border-radius: 12px;
        }

        .status-upcoming {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .status-in-progress {
            background-color: #fef3c7;
            color: #d97706;
        }

        .status-due-today {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .status-completed {
            background-color: #d1fae5;
            color: #059669;
        }

        /* Calendar View */
        .calendar-view {
            display: none;
        }

        .calendar-view.active {
            display: block;
        }

        /* Empty State */
        .events-empty {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .events-empty i {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 15px;
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
            .events-summary {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .events-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
            
            .sidebar {
                width: 70px;
            }
            
            .sidebar-links a span {
                display: none;
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
            
            .events-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .events-filters {
                flex-direction: column;
                width: 100%;
            }
            
            .filter-dropdown, .view-toggle {
                width: 100%;
            }
            
            .events-summary {
                grid-template-columns: 1fr;
            }

            .timeline-item-header {
                flex-direction: column;
                gap: 10px;
            }

            .event-date {
                text-align: left;
                display: flex;
                gap: 15px;
            }

            .event-actions {
                justify-content: flex-start;
            }

            .events-grid {
                grid-template-columns: 1fr;
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

            .event-meta {
                flex-direction: column;
                gap: 8px;
            }

            .event-actions {
                flex-wrap: wrap;
            }

            .timeline-items {
                padding-left: 20px;
            }

            .timeline-item::before {
                left: -26px;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="header-top">
            <div class="user-info justify-end flex">
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
                        
                        <!-- Navigation Links -->
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('student.events') }}" class="active">Upcoming Events</a></li>
                    </ul>
                </nav>
            </div>
            
            <!-- Student Portal Centered -->
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="logo-text">Upcoming Events</div>
            </div>
            
            <!-- Search, Notification, Profile on Right -->
            <div class="header-right">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Search events...">
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
    
    <!-- Main Content Area -->
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
            <div class="sidebar-links">
                <a href="{{ route('student.dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                <a href="{{ route('student.courses') }}"><i class="fas fa-book"></i> <span>My Courses</span></a>
                <a href="{{ route('student.leaderboard') }}"><i class="fas fa-trophy"></i> <span>Leaderboard</span></a>
                <a href="{{ route('student.events') }}" class="active"><i class="fas fa-calendar-alt"></i> <span>Upcoming Events</span></a>
                
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <div class="events-container">
                <!-- Events Header -->
                <div class="events-header">
                    <h1 class="events-title">Upcoming Events</h1>
                    <div class="events-filters">
                        <select class="filter-dropdown" id="course-filter">
                            <option value="all">All Courses</option>
                            <option value="math101">Mathematics 101</option>
                            <option value="cs201">Computer Science 201</option>
                            <option value="eng102">English 102</option>
                            <option value="phy301">Physics 301</option>
                        </select>
                        
                        <select class="filter-dropdown" id="type-filter">
                            <option value="all">All Event Types</option>
                            <option value="quiz">Quiz</option>
                            <option value="assignment">Assignment</option>
                            <option value="presentation">Presentation</option>
                            <option value="project">Project</option>
                            <option value="exam">Exam</option>
                        </select>
                        
                        <div class="view-toggle">
                            <button class="view-toggle-btn active" data-view="timeline">
                                <i class="fas fa-stream"></i> Timeline
                            </button>
                            <button class="view-toggle-btn" data-view="grid">
                                <i class="fas fa-th"></i> Grid
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Events Summary -->
                <div class="events-summary">
                    <div class="summary-card upcoming">
                        <div class="summary-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="summary-value">12</div>
                        <div class="summary-label">Upcoming Events</div>
                    </div>
                    
                    <div class="summary-card quiz">
                        <div class="summary-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="summary-value">5</div>
                        <div class="summary-label">Quizzes</div>
                    </div>
                    
                    <div class="summary-card assignment">
                        <div class="summary-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="summary-value">4</div>
                        <div class="summary-label">Assignments</div>
                    </div>
                    
                    <div class="summary-card submission">
                        <div class="summary-icon">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <div class="summary-value">3</div>
                        <div class="summary-label">Submissions Due</div>
                    </div>
                </div>
                
                <!-- Timeline View -->
                <div class="events-timeline" id="timeline-view">
                    <div class="timeline-header">
                        <h2 class="timeline-title">Upcoming Events Timeline</h2>
                        <div class="timeline-controls">
                            <button id="show-past">
                                <i class="fas fa-history"></i> Past Events
                            </button>
                            <button id="export-calendar">
                                <i class="fas fa-calendar-plus"></i> Export
                            </button>
                        </div>
                    </div>
                    
                    <div class="timeline-items">
                        <!-- Quiz Event -->
                        <div class="timeline-item quiz">
                            <div class="timeline-item-header">
                                <div class="event-type">
                                    <div class="event-type-icon">
                                        <i class="fas fa-question-circle"></i>
                                    </div>
                                    <span class="event-type-label">Quiz</span>
                                </div>
                                <div class="event-date">
                                    <div class="event-day">15</div>
                                    <div class="event-month">November 2024</div>
                                    <div class="event-time">10:00 AM - 11:30 AM</div>
                                </div>
                            </div>
                            <div class="event-content">
                                <h3 class="event-title">Mid-term Quiz: Algorithms & Data Structures</h3>
                                <p class="event-description">
                                    Comprehensive quiz covering topics from chapters 1-5. 
                                    Includes multiple choice, short answer, and coding problems.
                                    Duration: 90 minutes. Online proctored.
                                </p>
                            </div>
                            <div class="event-meta">
                                <div class="meta-item">
                                    <i class="fas fa-book"></i>
                                    <span>Course: Computer Science 201</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>Instructor: Dr. Sarah Johnson</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-weight"></i>
                                    <span>Weight: 15% of final grade</span>
                                </div>
                            </div>
                            <div class="event-actions">
                                <button class="event-btn secondary">
                                    <i class="fas fa-book"></i> Study Material
                                </button>
                                <button class="event-btn primary">
                                    <i class="fas fa-clock"></i> Set Reminder
                                </button>
                            </div>
                        </div>
                        
                        <!-- Assignment Submission -->
                        <div class="timeline-item assignment">
                            <div class="timeline-item-header">
                                <div class="event-type">
                                    <div class="event-type-icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <span class="event-type-label">Assignment Submission</span>
                                </div>
                                <div class="event-date">
                                    <div class="event-day">18</div>
                                    <div class="event-month">November 2024</div>
                                    <div class="event-time">11:59 PM</div>
                                </div>
                            </div>
                            <div class="event-content">
                                <h3 class="event-title">Programming Assignment #3: Binary Search Trees</h3>
                                <p class="event-description">
                                    Implement a binary search tree with insert, delete, search, and traversal operations.
                                    Submit source code and test cases. Include documentation and time complexity analysis.
                                </p>
                            </div>
                            <div class="event-meta">
                                <div class="meta-item">
                                    <i class="fas fa-book"></i>
                                    <span>Course: Computer Science 201</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-file-code"></i>
                                    <span>Format: Python/Java/C++</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-weight"></i>
                                    <span>Weight: 10% of final grade</span>
                                </div>
                            </div>
                            <div class="event-actions">
                                <button class="event-btn secondary">
                                    <i class="fas fa-eye"></i> View Assignment
                                </button>
                                <button class="event-btn primary">
                                    <i class="fas fa-upload"></i> Submit Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Project Report Submission -->
                        <div class="timeline-item project">
                            <div class="timeline-item-header">
                                <div class="event-type">
                                    <div class="event-type-icon">
                                        <i class="fas fa-project-diagram"></i>
                                    </div>
                                    <span class="event-type-label">Project Submission</span>
                                </div>
                                <div class="event-date">
                                    <div class="event-day">22</div>
                                    <div class="event-month">November 2024</div>
                                    <div class="event-time">11:59 PM</div>
                                </div>
                            </div>
                            <div class="event-content">
                                <h3 class="event-title">Final Project Report: Machine Learning Application</h3>
                                <p class="event-description">
                                    Submit complete project report including methodology, implementation, results, and analysis.
                                    Include source code, dataset, and presentation slides. Group project submission.
                                </p>
                            </div>
                            <div class="event-meta">
                                <div class="meta-item">
                                    <i class="fas fa-book"></i>
                                    <span>Course: Artificial Intelligence</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>Group Project (3 members)</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-weight"></i>
                                    <span>Weight: 25% of final grade</span>
                                </div>
                            </div>
                            <div class="event-actions">
                                <button class="event-btn secondary">
                                    <i class="fas fa-file-pdf"></i> Report Template
                                </button>
                                <button class="event-btn primary">
                                    <i class="fas fa-upload"></i> Upload Report
                                </button>
                            </div>
                        </div>
                        
                        <!-- Presentation -->
                        <div class="timeline-item presentation">
                            <div class="timeline-item-header">
                                <div class="event-type">
                                    <div class="event-type-icon">
                                        <i class="fas fa-presentation"></i>
                                    </div>
                                    <span class="event-type-label">Presentation</span>
                                </div>
                                <div class="event-date">
                                    <div class="event-day">25</div>
                                    <div class="event-month">November 2024</div>
                                    <div class="event-time">2:00 PM - 3:30 PM</div>
                                </div>
                            </div>
                            <div class="event-content">
                                <h3 class="event-title">Research Presentation: Cybersecurity Trends 2024</h3>
                                <p class="event-description">
                                    15-minute presentation followed by 5-minute Q&A session. 
                                    Present your research findings on current cybersecurity threats and prevention strategies.
                                </p>
                            </div>
                            <div class="event-meta">
                                <div class="meta-item">
                                    <i class="fas fa-book"></i>
                                    <span>Course: Cybersecurity Fundamentals</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>Instructor: Prof. Michael Chen</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>Duration: 20 minutes total</span>
                                </div>
                            </div>
                            <div class="event-actions">
                                <button class="event-btn secondary">
                                    <i class="fas fa-slideshare"></i> Presentation Guidelines
                                </button>
                                <button class="event-btn primary">
                                    <i class="fas fa-video"></i> Practice Session
                                </button>
                            </div>
                        </div>
                        
                        <!-- Exam -->
                        <div class="timeline-item exam">
                            <div class="timeline-item-header">
                                <div class="event-type">
                                    <div class="event-type-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <span class="event-type-label">Final Exam</span>
                                </div>
                                <div class="event-date">
                                    <div class="event-day">30</div>
                                    <div class="event-month">November 2024</div>
                                    <div class="event-time">9:00 AM - 12:00 PM</div>
                                </div>
                            </div>
                            <div class="event-content">
                                <h3 class="event-title">Final Examination: Advanced Mathematics</h3>
                                <p class="event-description">
                                    Comprehensive final exam covering all course material. 
                                    Closed book exam, calculator allowed. Bring student ID and writing materials.
                                </p>
                            </div>
                            <div class="event-meta">
                                <div class="meta-item">
                                    <i class="fas fa-book"></i>
                                    <span>Course: Mathematics 301</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Location: Main Hall, Room 204</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-weight"></i>
                                    <span>Weight: 35% of final grade</span>
                                </div>
                            </div>
                            <div class="event-actions">
                                <button class="event-btn secondary">
                                    <i class="fas fa-book-open"></i> Review Materials
                                </button>
                                <button class="event-btn primary">
                                    <i class="fas fa-calendar-check"></i> Add to Calendar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Grid View (Hidden by default) -->
                <div class="events-grid" id="grid-view" style="display: none;">
                    <!-- Grid items would go here -->
                </div>
                
                <!-- No Events Message -->
                <div class="events-empty" id="no-events" style="display: none;">
                    <i class="fas fa-calendar-times"></i>
                    <h3>No Upcoming Events</h3>
                    <p>You don't have any upcoming events at the moment.</p>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const navLinks = document.getElementById('nav-links');
            const overlay = document.getElementById('overlay');
            const profileIcon = document.getElementById('profile-icon');
            const profileDropdown = document.getElementById('profile-dropdown');
            const hamburger = document.querySelector('.hamburger');
            const sidebar = document.getElementById('sidebar');

            // Toggle mobile menu
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    navLinks.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
            }

            // Toggle sidebar on hamburger click
            if (hamburger && sidebar) {
                hamburger.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
            }

            // Close mobile menu when clicking overlay
            if (overlay) {
                overlay.addEventListener('click', function() {
                    navLinks.classList.remove('active');
                    sidebar.classList.remove('active');
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

            // View toggle functionality
            const viewToggleBtns = document.querySelectorAll('.view-toggle-btn');
            const timelineView = document.getElementById('timeline-view');
            const gridView = document.getElementById('grid-view');

            viewToggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const view = this.dataset.view;
                    
                    // Update active button
                    viewToggleBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show/hide views
                    if (view === 'timeline') {
                        timelineView.style.display = 'block';
                        gridView.style.display = 'none';
                    } else {
                        timelineView.style.display = 'none';
                        gridView.style.display = 'grid';
                    }
                });
            });

            // Filter functionality
            const courseFilter = document.getElementById('course-filter');
            const typeFilter = document.getElementById('type-filter');
            const searchInput = document.getElementById('search-input');
            const timelineItems = document.querySelectorAll('.timeline-item');

            function filterEvents() {
                const courseValue = courseFilter.value;
                const typeValue = typeFilter.value;
                const searchValue = searchInput.value.toLowerCase();
                let visibleCount = 0;

                timelineItems.forEach(item => {
                    const course = item.querySelector('.meta-item:nth-child(1) span')?.textContent.toLowerCase() || '';
                    const type = item.classList.contains('quiz') ? 'quiz' :
                                 item.classList.contains('assignment') ? 'assignment' :
                                 item.classList.contains('presentation') ? 'presentation' :
                                 item.classList.contains('project') ? 'project' : 'exam';
                    const title = item.querySelector('.event-title')?.textContent.toLowerCase() || '';
                    const description = item.querySelector('.event-description')?.textContent.toLowerCase() || '';
                    
                    const courseMatch = courseValue === 'all' || course.includes(courseValue);
                    const typeMatch = typeValue === 'all' || type === typeValue;
                    const searchMatch = searchValue === '' || 
                                        title.includes(searchValue) || 
                                        description.includes(searchValue);
                    
                    if (courseMatch && typeMatch && searchMatch) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Show/hide no events message
                const noEvents = document.getElementById('no-events');
                if (visibleCount === 0) {
                    noEvents.style.display = 'block';
                } else {
                    noEvents.style.display = 'none';
                }
            }

            // Add event listeners for filters
            courseFilter.addEventListener('change', filterEvents);
            typeFilter.addEventListener('change', filterEvents);
            searchInput.addEventListener('input', filterEvents);

            // Past events toggle
            const showPastBtn = document.getElementById('show-past');
            if (showPastBtn) {
                showPastBtn.addEventListener('click', function() {
                    alert('This would show past events in a real application.');
                });
            }

            // Export calendar
            const exportBtn = document.getElementById('export-calendar');
            if (exportBtn) {
                exportBtn.addEventListener('click', function() {
                    alert('Calendar export feature would be implemented here.');
                });
            }

            // Event action buttons
            document.querySelectorAll('.event-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const btnText = this.textContent.trim();
                    const eventTitle = this.closest('.timeline-item').querySelector('.event-title').textContent;
                    
                    if (btnText.includes('Set Reminder')) {
                        alert(`Reminder set for: ${eventTitle}`);
                    } else if (btnText.includes('Submit Now') || btnText.includes('Upload')) {
                        alert(`Redirecting to submission page for: ${eventTitle}`);
                    } else if (btnText.includes('Study Material') || btnText.includes('View Assignment')) {
                        alert(`Opening materials for: ${eventTitle}`);
                    }
                });
            });

            // Initialize filters
            filterEvents();
        });
    </script>
</body>
</html>