<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Student Portal</title>
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

        /* Courses Page Styles */
        .courses-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .courses-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .courses-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .courses-filters {
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

        .semester-filter {
            display: flex;
            gap: 5px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .semester-btn {
            padding: 8px 15px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .semester-btn.active {
            background-color: #0369a1;
            color: white;
        }

        .semester-btn:hover:not(.active) {
            background-color: #f5f5f5;
        }

        /* Statistics Cards */
        .courses-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card-courses {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-top: 4px solid #0369a1;
        }

        .stat-value-courses {
            font-size: 2rem;
            font-weight: bold;
            color: #0369a1;
            margin-bottom: 5px;
        }

        .stat-label-courses {
            color: #666;
            font-size: 0.9rem;
        }

        /* Semester Sections */
        .semester-section {
            margin-bottom: 40px;
        }

        .semester-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e5e7eb;
        }

        .semester-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: #333;
        }

        .semester-info {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #666;
            font-size: 0.9rem;
        }

        .semester-badge {
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* Courses Grid */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .course-card-full {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
        }

        .course-card-full:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .course-card-header {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .course-code {
            font-weight: bold;
            color: #0369a1;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .course-title-full {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .course-instructor {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 0.85rem;
        }

        .course-status {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background-color: #d1fae5;
            color: #059669;
        }

        .status-completed {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .status-upcoming {
            background-color: #fef3c7;
            color: #d97706;
        }

        .course-card-content {
            padding: 20px;
        }

        .course-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .course-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            color: #666;
        }

        .meta-item i {
            color: #0369a1;
            width: 16px;
        }

        .progress-section {
            margin-bottom: 20px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .progress-label {
            font-size: 0.9rem;
            color: #666;
        }

        .progress-percentage {
            font-weight: 600;
            color: #0369a1;
        }

        .progress-bar-full {
            height: 8px;
            background-color: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill-full {
            height: 100%;
            background-color: #0369a1;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .course-card-footer {
            padding: 15px 20px;
            background-color: #f8fafc;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .course-actions {
            display: flex;
            gap: 10px;
        }

        .course-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .course-btn.primary {
            background-color: #0369a1;
            color: white;
        }

        .course-btn.primary:hover {
            background-color: #0284c7;
        }

        .course-btn.secondary {
            background-color: white;
            color: #333;
            border: 1px solid #ddd;
        }

        .course-btn.secondary:hover {
            background-color: #f5f5f5;
        }

        .course-btn.outline {
            background-color: transparent;
            color: #0369a1;
            border: 1px solid #0369a1;
        }

        .course-btn.outline:hover {
            background-color: #e0f2fe;
        }

        .last-accessed {
            font-size: 0.85rem;
            color: #666;
        }

        /* Empty State */
        .courses-empty {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .courses-empty i {
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
        @media (max-width: 1200px) {
            .courses-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 1024px) {
            .courses-stats {
                grid-template-columns: repeat(2, 1fr);
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
            
            .courses-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .courses-filters {
                flex-direction: column;
                width: 100%;
            }
            
            .filter-dropdown, .semester-filter {
                width: 100%;
            }
            
            .courses-stats {
                grid-template-columns: 1fr;
            }

            .courses-grid {
                grid-template-columns: 1fr;
            }

            .course-card-footer {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .course-actions {
                width: 100%;
                justify-content: space-between;
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

            .course-meta {
                flex-direction: column;
                gap: 8px;
            }

            .course-actions {
                flex-direction: column;
                gap: 8px;
            }

            .course-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="header-top">
            <div class="user-info justify-end flex">
                <span><i class="fas fa-user-circle mr-1"></i> <?php echo e(Auth::user()->name ?? 'John Doe'); ?></span>
                <span><i class="fas fa-envelope mr-1"></i> <?php echo e(Auth::user()->email ?? 'john.doe@example.com'); ?></span>
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
                            <a href="<?php echo e(url('/')); ?>">Digital E-Learning</a>
                        </li>
                        
                        <!-- Navigation Links -->
                        <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li><a href="<?php echo e(route('student.dashboard')); ?>">Dashboard</a></li>
                        <li><a href="<?php echo e(route('student.courses')); ?>" class="active">All My Courses</a></li>
            
                    </ul>
                </nav>
            </div>
            
            <!-- Student Portal Centered -->
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="logo-text">My Courses</div>
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
                        <a href="<?php echo e(route('logout')); ?>" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt"></i> Log out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Logout Form -->
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
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
                <a href="<?php echo e(route('student.dashboard')); ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                <a href="<?php echo e(route('student.courses')); ?>" class="active"><i class="fas fa-book"></i> <span>All My Courses</span></a>
                <a href="<?php echo e(route('student.leaderboard')); ?>"><i class="fas fa-trophy"></i> <span>Leaderboard</span></a>
                <a href="<?php echo e(route('student.events')); ?>"><i class="fas fa-calendar-alt"></i> <span>Upcoming Events</span></a>
               
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <div class="courses-container">
                <!-- Courses Header -->
                <div class="courses-header">
                    <h1 class="courses-title">All My Courses</h1>
                    <div class="courses-filters">
                        <select class="filter-dropdown" id="status-filter">
                            <option value="all">All Status</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="upcoming">Upcoming</option>
                        </select>
                        
                        <div class="semester-filter" id="semester-filter">
                            <button class="semester-btn active" data-semester="all">All Semesters</button>
                            <button class="semester-btn" data-semester="current">Current</button>
                            <button class="semester-btn" data-semester="past">Past</button>
                        </div>
                    </div>
                </div>
                
                <!-- Statistics Cards -->
                <div class="courses-stats">
                    <div class="stat-card-courses">
                        <div class="stat-value-courses">12</div>
                        <div class="stat-label-courses">Total Courses</div>
                    </div>
                    
                    <div class="stat-card-courses">
                        <div class="stat-value-courses">8</div>
                        <div class="stat-label-courses">Active Courses</div>
                    </div>
                    
                    <div class="stat-card-courses">
                        <div class="stat-value-courses">4</div>
                        <div class="stat-label-courses">Completed</div>
                    </div>
                    
                    <div class="stat-card-courses">
                        <div class="stat-value-courses">78%</div>
                        <div class="stat-label-courses">Average Progress</div>
                    </div>
                </div>
                
                <!-- Current Semester -->
                <div class="semester-section" id="current-semester">
                    <div class="semester-header">
                        <h2 class="semester-title">Current Semester - Fall 2024</h2>
                        <div class="semester-info">
                            <span class="semester-badge">In Progress</span>
                            <span><i class="fas fa-calendar-alt"></i> Aug 2024 - Dec 2024</span>
                            <span><i class="fas fa-book"></i> 6 Courses</span>
                        </div>
                    </div>
                    
                    <div class="courses-grid">
                        <!-- Course Card 1 -->
                        <div class="course-card-full" data-status="active" data-semester="current">
                            <div class="course-card-header">
                                <div>
                                    <div class="course-code">CS-201</div>
                                    <h3 class="course-title-full">Data Structures and Algorithms</h3>
                                    <div class="course-instructor">
                                        <i class="fas fa-user-tie"></i>
                                        <span>Prof. Sarah Johnson</span>
                                    </div>
                                </div>
                            </div>
                            <span class="course-status status-active">Active</span>
                            
                            <div class="course-card-content">
                                <p class="course-description">
                                    Learn fundamental data structures and algorithms. Covers arrays, linked lists, trees, graphs, and sorting algorithms.
                                </p>
                                
                                <div class="course-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-credit-card"></i>
                                        <span>3 Credits</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Mon, Wed 10:00 AM</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-users"></i>
                                        <span>45 Students</span>
                                    </div>
                                </div>
                                
                                <div class="progress-section">
                                    <div class="progress-header">
                                        <span class="progress-label">Course Progress</span>
                                        <span class="progress-percentage">85%</span>
                                    </div>
                                    <div class="progress-bar-full">
                                        <div class="progress-fill-full" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="course-card-footer">
                                <div class="last-accessed">
                                    <i class="far fa-clock"></i> Last accessed: 2 hours ago
                                </div>
                                <div class="course-actions">
                                    <button class="course-btn outline" onclick="viewCourseMaterials(1)">
                                        <i class="fas fa-folder"></i> Materials
                                    </button>
                                    <button class="course-btn primary" onclick="viewCourse(1)">
                                        <i class="fas fa-play-circle"></i> Continue
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Course Card 2 -->
                        <div class="course-card-full" data-status="active" data-semester="current">
                            <div class="course-card-header">
                                <div>
                                    <div class="course-code">MATH-301</div>
                                    <h3 class="course-title-full">Advanced Calculus</h3>
                                    <div class="course-instructor">
                                        <i class="fas fa-user-tie"></i>
                                        <span>Prof. Robert Wilson</span>
                                    </div>
                                </div>
                            </div>
                            <span class="course-status status-active">Active</span>
                            
                            <div class="course-card-content">
                                <p class="course-description">
                                    Multivariable calculus, vector calculus, and differential equations. Applications in physics and engineering.
                                </p>
                                
                                <div class="course-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-credit-card"></i>
                                        <span>4 Credits</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Tue, Thu 2:00 PM</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-users"></i>
                                        <span>32 Students</span>
                                    </div>
                                </div>
                                
                                <div class="progress-section">
                                    <div class="progress-header">
                                        <span class="progress-label">Course Progress</span>
                                        <span class="progress-percentage">72%</span>
                                    </div>
                                    <div class="progress-bar-full">
                                        <div class="progress-fill-full" style="width: 72%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="course-card-footer">
                                <div class="last-accessed">
                                    <i class="far fa-clock"></i> Last accessed: 1 day ago
                                </div>
                                <div class="course-actions">
                                    <button class="course-btn outline" onclick="viewCourseMaterials(2)">
                                        <i class="fas fa-folder"></i> Materials
                                    </button>
                                    <button class="course-btn primary" onclick="viewCourse(2)">
                                        <i class="fas fa-play-circle"></i> Continue
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Course Card 3 -->
                        <div class="course-card-full" data-status="active" data-semester="current">
                            <div class="course-card-header">
                                <div>
                                    <div class="course-code">ENG-102</div>
                                    <h3 class="course-title-full">Technical Writing</h3>
                                    <div class="course-instructor">
                                        <i class="fas fa-user-tie"></i>
                                        <span>Prof. Emily Davis</span>
                                    </div>
                                </div>
                            </div>
                            <span class="course-status status-active">Active</span>
                            
                            <div class="course-card-content">
                                <p class="course-description">
                                    Learn professional writing skills for technical documents, reports, and proposals in engineering and science fields.
                                </p>
                                
                                <div class="course-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-credit-card"></i>
                                        <span>3 Credits</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Mon, Fri 11:00 AM</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-users"></i>
                                        <span>28 Students</span>
                                    </div>
                                </div>
                                
                                <div class="progress-section">
                                    <div class="progress-header">
                                        <span class="progress-label">Course Progress</span>
                                        <span class="progress-percentage">90%</span>
                                    </div>
                                    <div class="progress-bar-full">
                                        <div class="progress-fill-full" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="course-card-footer">
                                <div class="last-accessed">
                                    <i class="far fa-clock"></i> Last accessed: 3 hours ago
                                </div>
                                <div class="course-actions">
                                    <button class="course-btn outline" onclick="viewCourseMaterials(3)">
                                        <i class="fas fa-folder"></i> Materials
                                    </button>
                                    <button class="course-btn primary" onclick="viewCourse(3)">
                                        <i class="fas fa-play-circle"></i> Continue
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Past Semesters -->
                <div class="semester-section" id="past-semesters">
                    <div class="semester-header">
                        <h2 class="semester-title">Past Semesters</h2>
                        <div class="semester-info">
                            <span><i class="fas fa-history"></i> Completed Courses</span>
                        </div>
                    </div>
                    
                    <div class="courses-grid">
                        <!-- Course Card 4 - Completed -->
                        <div class="course-card-full" data-status="completed" data-semester="past">
                            <div class="course-card-header">
                                <div>
                                    <div class="course-code">CS-101</div>
                                    <h3 class="course-title-full">Introduction to Programming</h3>
                                    <div class="course-instructor">
                                        <i class="fas fa-user-tie"></i>
                                        <span>Prof. Michael Chen</span>
                                    </div>
                                </div>
                            </div>
                            <span class="course-status status-completed">Completed</span>
                            
                            <div class="course-card-content">
                                <p class="course-description">
                                    Fundamentals of programming using Python. Covers variables, loops, functions, and basic data structures.
                                </p>
                                
                                <div class="course-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-credit-card"></i>
                                        <span>4 Credits</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span>Spring 2024</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-star"></i>
                                        <span>Grade: A</span>
                                    </div>
                                </div>
                                
                                <div class="progress-section">
                                    <div class="progress-header">
                                        <span class="progress-label">Course Progress</span>
                                        <span class="progress-percentage">100%</span>
                                    </div>
                                    <div class="progress-bar-full">
                                        <div class="progress-fill-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="course-card-footer">
                                <div class="last-accessed">
                                    <i class="far fa-calendar-check"></i> Completed: May 15, 2024
                                </div>
                                <div class="course-actions">
                                    <button class="course-btn secondary" onclick="viewCertificate(4)">
                                        <i class="fas fa-certificate"></i> Certificate
                                    </button>
                                    <button class="course-btn outline" onclick="reviewCourse(4)">
                                        <i class="fas fa-redo"></i> Review
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Course Card 5 - Completed -->
                        <div class="course-card-full" data-status="completed" data-semester="past">
                            <div class="course-card-header">
                                <div>
                                    <div class="course-code">PHYS-201</div>
                                    <h3 class="course-title-full">University Physics I</h3>
                                    <div class="course-instructor">
                                        <i class="fas fa-user-tie"></i>
                                        <span>Prof. David Brown</span>
                                    </div>
                                </div>
                            </div>
                            <span class="course-status status-completed">Completed</span>
                            
                            <div class="course-card-content">
                                <p class="course-description">
                                    Mechanics, thermodynamics, and waves. Calculus-based introduction to physics for engineering students.
                                </p>
                                
                                <div class="course-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-credit-card"></i>
                                        <span>4 Credits</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span>Spring 2024</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-star"></i>
                                        <span>Grade: B+</span>
                                    </div>
                                </div>
                                
                                <div class="progress-section">
                                    <div class="progress-header">
                                        <span class="progress-label">Course Progress</span>
                                        <span class="progress-percentage">100%</span>
                                    </div>
                                    <div class="progress-bar-full">
                                        <div class="progress-fill-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="course-card-footer">
                                <div class="last-accessed">
                                    <i class="far fa-calendar-check"></i> Completed: May 18, 2024
                                </div>
                                <div class="course-actions">
                                    <button class="course-btn secondary" onclick="viewCertificate(5)">
                                        <i class="fas fa-certificate"></i> Certificate
                                    </button>
                                    <button class="course-btn outline" onclick="reviewCourse(5)">
                                        <i class="fas fa-redo"></i> Review
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                       
                    </div>
                </div>
                
                <!-- No Courses Message (Hidden by default) -->
                <div class="courses-empty" id="no-courses" style="display: none;">
                    <i class="fas fa-book-open"></i>
                    <h3>No Courses Found</h3>
                    <p>You haven't enrolled in any courses yet.</p>
                    <button class="course-btn primary" onclick="window.location.href='/courses'">
                        <i class="fas fa-search"></i> Browse Available Courses
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="max-w-7xl mx-auto px-4">
            <p>© <?php echo e(date('Y')); ?> Digital E-Learning Platform. All rights reserved.</p>
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

            // Filter functionality
            const statusFilter = document.getElementById('status-filter');
            const semesterBtns = document.querySelectorAll('.semester-btn');
            const searchInput = document.getElementById('search-input');
            const courseCards = document.querySelectorAll('.course-card-full');

            function filterCourses() {
                const statusValue = statusFilter.value;
                const semesterValue = document.querySelector('.semester-btn.active').dataset.semester;
                const searchValue = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                courseCards.forEach(card => {
                    const cardStatus = card.dataset.status;
                    const cardSemester = card.dataset.semester;
                    const title = card.querySelector('.course-title-full')?.textContent.toLowerCase() || '';
                    const code = card.querySelector('.course-code')?.textContent.toLowerCase() || '';
                    const instructor = card.querySelector('.course-instructor span')?.textContent.toLowerCase() || '';
                    
                    const statusMatch = statusValue === 'all' || cardStatus === statusValue;
                    const semesterMatch = semesterValue === 'all' || cardSemester === semesterValue;
                    const searchMatch = searchValue === '' || 
                                        title.includes(searchValue) || 
                                        code.includes(searchValue) ||
                                        instructor.includes(searchValue);
                    
                    if (statusMatch && semesterMatch && searchMatch) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide no courses message
                const noCourses = document.getElementById('no-courses');
                if (visibleCount === 0) {
                    noCourses.style.display = 'block';
                } else {
                    noCourses.style.display = 'none';
                }
            }

            // Add event listeners for filters
            statusFilter.addEventListener('change', filterCourses);
            searchInput.addEventListener('input', filterCourses);

            // Semester filter buttons
            semesterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    semesterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    filterCourses();
                });
            });

            // Initialize filters
            filterCourses();
        });

        // Course action functions
        function viewCourse(courseId) {
            alert(`Redirecting to course ${courseId}...`);
            // In real implementation:
            // window.location.href = `/student/courses/${courseId}`;
        }

        function viewCourseMaterials(courseId) {
            alert(`Opening course materials for course ${courseId}...`);
            // In real implementation:
            // window.location.href = `/student/courses/${courseId}/materials`;
        }

        function viewCertificate(courseId) {
            alert(`Opening certificate for course ${courseId}...`);
            // In real implementation:
            // window.location.href = `/student/certificates/${courseId}`;
        }

        function reviewCourse(courseId) {
            alert(`Opening review materials for course ${courseId}...`);
            // In real implementation:
            // window.location.href = `/student/courses/${courseId}/review`;
        }

        function viewSyllabus(courseId) {
            alert(`Opening syllabus for course ${courseId}...`);
            // In real implementation:
            // window.location.href = `/student/courses/${courseId}/syllabus`;
        }
    </script>
</body>
</html><?php /**PATH C:\Users\User\blc-elearning\resources\views/student/courses.blade.php ENDPATH**/ ?>