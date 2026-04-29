<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction to Web Engineering - Learning | Digital E-Learning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2196f3;
            --secondary-color: #6ec6ff;
            --dark-color: #2c3e50;
            --success-color: #4caf50;
            --warning-color: #ff9800;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        
        /* Student Dashboard Header Styles */
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

        /* Mobile menu button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: #555;
        }

        /* Responsive design for header */
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

        /* Course Header */
        .course-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        
        .course-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .course-meta {
            display: flex;
            gap: 20px;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        /* Progress Section */
        .progress-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .progress-container {
            background: #e9ecef;
            border-radius: 10px;
            height: 12px;
            margin: 15px 0;
            overflow: hidden;
        }
        
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 10px;
            transition: width 0.5s ease;
        }
        
        /* Course Content */
        .content-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .module-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .module-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(33, 150, 243, 0.1);
        }
        
        .module-header {
            background: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .module-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }
        
        .lesson-list {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        
        .lesson-item {
            padding: 18px 20px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: background 0.3s ease;
        }
        
        .lesson-item:hover {
            background: #f8f9fa;
        }
        
        .lesson-item:last-child {
            border-bottom: none;
        }
        
        .lesson-status {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }
        
        .status-not-started {
            background: #e9ecef;
            color: #6c757d;
        }
        
        .status-in-progress {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        
        .lesson-content {
            flex: 1;
        }
        
        .lesson-title {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .lesson-duration {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        /* Sidebar */
        .sidebar-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 20px;
        }
        
        .instructor-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 25px;
        }
        
        .instructor-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }
        
        .quick-actions {
            list-style: none;
            padding: 0;
            margin: 0 0 25px 0;
        }
        
        .quick-actions li {
            margin-bottom: 10px;
        }
        
        .quick-actions a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            background: #f8f9fa;
            border-radius: 8px;
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .quick-actions a:hover {
            background: var(--primary-color);
            color: white;
            transform: translateX(5px);
        }
        
        /* Completion Modal */
        .completion-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .completion-content {
            background: white;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        
        .completion-icon {
            font-size: 4rem;
            color: var(--success-color);
            margin-bottom: 20px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .course-title {
                font-size: 1.5rem;
            }
            
            .course-meta {
                flex-direction: column;
                gap: 5px;
            }
            
            .sidebar-card {
                position: static;
                margin-top: 25px;
            }
        }
        
        /* Lesson Content Styles */
        .lesson-content-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            margin: 20px 0;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .resource-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        
        .resource-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
            text-decoration: none;
            color: var(--dark-color);
            transition: all 0.3s ease;
        }
        
        .resource-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        
        /* Navigation Buttons */
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        
        .nav-btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-prev {
            background: #f8f9fa;
            color: var(--dark-color);
            border: 1px solid #e9ecef;
        }
        
        .btn-next {
            background: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-color);
        }
        
        .btn-prev:hover {
            background: #e9ecef;
        }
        
        .btn-next:hover {
            background: #1976d2;
        }
        
        /* Quiz Styles */
        .quiz-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .quiz-question {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 25px;
            color: var(--dark-color);
        }
        
        .quiz-option {
            padding: 15px;
            margin-bottom: 10px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .quiz-option:hover {
            border-color: var(--primary-color);
            background: #f8f9fa;
        }
        
        .quiz-option.selected {
            border-color: var(--primary-color);
            background: #e3f2fd;
        }
        
        .quiz-option.correct {
            border-color: var(--success-color);
            background: #d4edda;
        }
        
        .quiz-option.incorrect {
            border-color: #dc3545;
            background: #f8d7da;
        }
        
        /* Completion Badge */
        .completion-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--success-color);
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Student Dashboard Header -->
    <header class="header">
        <div class="header-top">
            <div class="user-info justify-end flex">
                <span><i class="bi bi-person-circle"></i> Student Name</span>
                <span><i class="bi bi-envelope"></i> student@example.com</span>
                <span><i class="bi bi-mortarboard"></i> Student</span>
            </div>
        </div>
        
        <div class="header-bottom">
            <!-- Navigation Links on Left -->
            <div class="nav-container">
                <nav>
                    <button class="mobile-menu-btn" id="mobile-menu-btn">
                        <i class="bi bi-list"></i>
                    </button>
                    <ul class="nav-links" id="nav-links">
                        <!-- System Name with Logo and Home Link -->
                        <li class="system-name">
                            <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Digital E-Learning Logo" class="system-logo">
                            <a href="{{ url('/') }}">Digital E-Learning</a>
                        </li>
                        
                        <!-- Original Navigation Links -->
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('courses.index') }}">Courses</a></li>
                    </ul>
                </nav>
            </div>
            
            <!-- Student Portal Centered -->
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <div class="logo-text">Student Portal</div>
            </div>
            
            <!-- Search, Notification, Profile on Right -->
            <div class="header-right">
                <div class="search-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" id="search-input" placeholder="Search courses...">
                </div>
                
                <div class="notification-icon">
                    <i class="bi bi-bell"></i>
                </div>
                
                <div class="profile-icon" id="profile-icon">
                    <i class="bi bi-person"></i>
                    <div class="profile-dropdown" id="profile-dropdown">
                        <a href="#"><i class="bi bi-person"></i> Profile</a>
                        <a href="#"><i class="bi bi-calendar"></i> Calendar</a>
                        <a href="#"><i class="bi bi-gear"></i> Settings</a>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="bi bi-box-arrow-right"></i> Log out
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

    <!-- Course Header -->
    <div class="course-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="course-title">Introduction to Web Engineering</h1>
                    <div class="course-meta">
                        <span><i class="bi bi-person"></i> Rajib Khan</span>
                        <span><i class="bi bi-clock"></i> 8 weeks</span>
                        <span><i class="bi bi-bar-chart"></i> Intermediate</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('student.dashboard') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Progress Section -->
                <div class="progress-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Your Progress</h3>
                        <span class="badge bg-primary">65% Complete</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: 65%"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <small>Started: Jan 15, 2024</small>
                        <small>Estimated Completion: Mar 31, 2024</small>
                    </div>
                </div>

                <!-- Course Content -->
                <div class="content-section">
                    <h3 class="mb-4">Course Content</h3>
                    
                    <!-- Module 1 -->
                    <div class="module-card">
                        <div class="module-header" data-bs-toggle="collapse" data-bs-target="#module-1">
                            <h4 class="module-title">Module 1: HTML Fundamentals</h4>
                            <span class="badge bg-light text-dark">
                                3/5 Completed
                            </span>
                        </div>
                        <div class="collapse show" id="module-1">
                            <ul class="lesson-list">
                                <li class="lesson-item">
                                    <div class="lesson-status status-completed">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            Introduction to HTML
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 25 min
                                            <i class="bi bi-play-circle ms-2"></i> Video
                                        </div>
                                    </div>
                                    <span class="completion-badge">
                                        <i class="bi bi-check-circle"></i> Completed
                                    </span>
                                </li>
                                <li class="lesson-item">
                                    <div class="lesson-status status-completed">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            HTML Elements and Tags
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 35 min
                                            <i class="bi bi-play-circle ms-2"></i> Video
                                        </div>
                                    </div>
                                    <span class="completion-badge">
                                        <i class="bi bi-check-circle"></i> Completed
                                    </span>
                                </li>
                                <li class="lesson-item">
                                    <div class="lesson-status status-completed">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            Forms and Input Elements
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 40 min
                                            <i class="bi bi-play-circle ms-2"></i> Video
                                        </div>
                                    </div>
                                    <span class="completion-badge">
                                        <i class="bi bi-check-circle"></i> Completed
                                    </span>
                                </li>
                                <li class="lesson-item">
                                    <div class="lesson-status status-in-progress">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            HTML5 Semantic Elements
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 30 min
                                            <i class="bi bi-file-text ms-2"></i> Reading
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        Continue
                                    </a>
                                </li>
                                <li class="lesson-item">
                                    <div class="lesson-status status-not-started">
                                        <i class="bi bi-circle"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            Module 1 Quiz
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 20 min
                                            <i class="bi bi-question-circle ms-2"></i> Quiz
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        Start
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Module 2 -->
                    <div class="module-card">
                        <div class="module-header" data-bs-toggle="collapse" data-bs-target="#module-2">
                            <h4 class="module-title">Module 2: CSS Styling</h4>
                            <span class="badge bg-light text-dark">
                                1/4 Completed
                            </span>
                        </div>
                        <div class="collapse" id="module-2">
                            <ul class="lesson-list">
                                <li class="lesson-item">
                                    <div class="lesson-status status-completed">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            Introduction to CSS
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 30 min
                                            <i class="bi bi-play-circle ms-2"></i> Video
                                        </div>
                                    </div>
                                    <span class="completion-badge">
                                        <i class="bi bi-check-circle"></i> Completed
                                    </span>
                                </li>
                                <li class="lesson-item">
                                    <div class="lesson-status status-not-started">
                                        <i class="bi bi-circle"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            CSS Selectors and Properties
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 45 min
                                            <i class="bi bi-play-circle ms-2"></i> Video
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        Start
                                    </a>
                                </li>
                                <li class="lesson-item">
                                    <div class="lesson-status status-not-started">
                                        <i class="bi bi-circle"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            Flexbox and Grid Layout
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 60 min
                                            <i class="bi bi-play-circle ms-2"></i> Video
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        Start
                                    </a>
                                </li>
                                <li class="lesson-item">
                                    <div class="lesson-status status-not-started">
                                        <i class="bi bi-circle"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            CSS Animations and Transitions
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 40 min
                                            <i class="bi bi-file-text ms-2"></i> Reading
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        Start
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Module 3 -->
                    <div class="module-card">
                        <div class="module-header" data-bs-toggle="collapse" data-bs-target="#module-3">
                            <h4 class="module-title">Module 3: JavaScript Basics</h4>
                            <span class="badge bg-light text-dark">
                                0/3 Not Started
                            </span>
                        </div>
                        <div class="collapse" id="module-3">
                            <ul class="lesson-list">
                                <li class="lesson-item">
                                    <div class="lesson-status status-not-started">
                                        <i class="bi bi-circle"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            JavaScript Syntax and Variables
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 35 min
                                            <i class="bi bi-play-circle ms-2"></i> Video
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        Start
                                    </a>
                                </li>
                                <li class="lesson-item">
                                    <div class="lesson-status status-not-started">
                                        <i class="bi bi-circle"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            Functions and Control Flow
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 50 min
                                            <i class="bi bi-play-circle ms-2"></i> Video
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        Start
                                    </a>
                                </li>
                                <li class="lesson-item">
                                    <div class="lesson-status status-not-started">
                                        <i class="bi bi-circle"></i>
                                    </div>
                                    <div class="lesson-content">
                                        <a href="#" class="lesson-title d-block text-decoration-none text-dark">
                                            DOM Manipulation
                                        </a>
                                        <div class="lesson-duration">
                                            <i class="bi bi-clock"></i> 55 min
                                            <i class="bi bi-play-circle ms-2"></i> Video
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        Start
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Course Description -->
                <div class="content-section">
                    <h3 class="mb-4">About This Course</h3>
                    <div class="course-description">
                        <p>Welcome to Introduction to Web Development! This comprehensive course is designed for beginners who want to learn the fundamental building blocks of web development.</p>
                        
                        <h5>What You'll Learn:</h5>
                        <ul>
                            <li>Create websites using HTML5 and CSS3</li>
                            <li>Build responsive layouts that work on all devices</li>
                            <li>Add interactivity with JavaScript</li>
                            <li>Understand web development best practices</li>
                            <li>Deploy your first website to the web</li>
                        </ul>
                        
                        <h5>Course Structure:</h5>
                        <p>This 8-week course includes 12 modules with video lectures, hands-on exercises, quizzes, and a final project. Each week, you'll build upon what you've learned to create increasingly complex web applications.</p>
                        
                        <h5>Prerequisites:</h5>
                        <p>No prior programming experience required! All you need is a computer with internet access and enthusiasm to learn.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-card">
                    <!-- Instructor Info -->
                    <div class="instructor-card">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Instructor" class="instructor-avatar">
                        <div>
                            <h5 class="mb-1">Dr. Sarah Johnson</h5>
                            <p class="text-muted mb-0">Course Instructor</p>
                            <small><i class="bi bi-star-fill text-warning"></i> 4.8 Instructor Rating</small>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <h5 class="mb-3">Quick Actions</h5>
                    <ul class="quick-actions">
                        <li>
                            <a href="#">
                                <i class="bi bi-download"></i>
                                <span>Download Materials</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="bi bi-question-circle"></i>
                                <span>Ask a Question</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="bi bi-chat-left-text"></i>
                                <span>Course Discussions</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="bi bi-journal-text"></i>
                                <span>Take Notes</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="certificate-btn">
                                <i class="bi bi-award"></i>
                                <span>View Certificate</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Course Stats -->
                    <h5 class="mb-3">Course Statistics</h5>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Course Rating</span>
                            <span class="text-warning">
                                <i class="bi bi-star-fill"></i> 4.7/5.0
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Students</span>
                            <span>2,548</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Language</span>
                            <span>English</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Category</span>
                            <span class="badge bg-light text-dark">Web Development</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Last Updated</span>
                            <span>Feb 15, 2024</span>
                        </div>
                    </div>

                    <!-- Progress Actions -->
                    <div class="mt-4">
                        <div id="progress-section">
                            <button class="btn btn-success w-100 mb-2" id="mark-complete-btn">
                                <i class="bi bi-check-circle"></i> Mark Course as Complete
                            </button>
                            <button class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#unenrollModal">
                                <i class="bi bi-x-circle"></i> Unenroll from Course
                            </button>
                        </div>
                        
                        <div id="completed-section" style="display: none;">
                            <div class="alert alert-success text-center">
                                <i class="bi bi-trophy"></i>
                                <strong>Course Completed!</strong>
                                <div class="mt-2">
                                    <a href="#" class="btn btn-outline-success btn-sm">
                                        Download Certificate
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Unenroll Modal -->
    <div class="modal fade" id="unenrollModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Unenrollment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to unenroll from <strong>Introduction to Web Development</strong>?</p>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        This action cannot be undone. Your progress will be lost.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="unenrollCourse()">Yes, Unenroll</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Completion Modal -->
    <div class="completion-modal" id="completionModal">
        <div class="completion-content">
            <div class="completion-icon">
                <i class="bi bi-trophy-fill"></i>
            </div>
            <h3>Congratulations!</h3>
            <p class="text-muted">You have successfully completed <strong>Introduction to Web Development</strong></p>
            <div class="mt-4">
                <button class="btn btn-primary" onclick="closeCompletionModal()">Continue Learning</button>
                <a href="#" class="btn btn-success">Download Certificate</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Header functionality
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
                document.addEventListener('click', function(event) {
                    if (!profileIcon.contains(event.target)) {
                        profileDropdown.classList.remove('active');
                    }
                });
            }

            // Search functionality
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    console.log('Searching for:', this.value);
                });
            }
        });

        // Course functionality
        // Current progress
        let currentProgress = 65;
        
        // Progress update
        document.getElementById('mark-complete-btn').addEventListener('click', function() {
            if (confirm('Mark this course as complete? This will update your progress to 100%.')) {
                updateProgress(100);
            }
        });

        // Update progress
        function updateProgress(progress) {
            // Update progress bar
            const progressBar = document.querySelector('.progress-section .progress-bar');
            const progressBadge = document.querySelector('.badge.bg-primary');
            
            if (progressBar) progressBar.style.width = progress + '%';
            if (progressBadge) progressBadge.textContent = progress + '% Complete';
            currentProgress = progress;
            
            // Show completion modal if 100%
            if (progress === 100) {
                showCompletionModal();
                
                // Show completed section in sidebar
                const progressSection = document.getElementById('progress-section');
                const completedSection = document.getElementById('completed-section');
                if (progressSection) progressSection.style.display = 'none';
                if (completedSection) completedSection.style.display = 'block';
            }
        }

        // Show completion modal
        function showCompletionModal() {
            const completionModal = document.getElementById('completionModal');
            if (completionModal) completionModal.style.display = 'flex';
        }

        // Close completion modal
        function closeCompletionModal() {
            const completionModal = document.getElementById('completionModal');
            if (completionModal) completionModal.style.display = 'none';
            location.reload();
        }

        // Toggle module content
        document.querySelectorAll('.module-header').forEach(header => {
            header.addEventListener('click', function() {
                const icon = this.querySelector('.bi');
                if (icon) {
                    if (icon.classList.contains('bi-chevron-down')) {
                        icon.classList.remove('bi-chevron-down');
                        icon.classList.add('bi-chevron-up');
                    } else {
                        icon.classList.remove('bi-chevron-up');
                        icon.classList.add('bi-chevron-down');
                    }
                }
            });
        });

        // Add chevron icons to module headers
        document.querySelectorAll('.module-header').forEach(header => {
            const icon = document.createElement('i');
            icon.className = 'bi bi-chevron-down ms-2';
            header.appendChild(icon);
        });

        // Certificate button
        const certificateBtn = document.getElementById('certificate-btn');
        if (certificateBtn) {
            certificateBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentProgress >= 100) {
                    // Show certificate
                    alert('Certificate would be displayed here. In production, this would generate/download a certificate.');
                } else {
                    alert('Complete the course (100% progress) to unlock your certificate!');
                }
            });
        }

        // Unenroll course
        function unenrollCourse() {
            alert('In production, this would unenroll you from the course. For demo, we\'ll just close the modal.');
            const modal = bootstrap.Modal.getInstance(document.getElementById('unenrollModal'));
            modal.hide();
        }

        // Initialize Bootstrap components
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize collapse with animation
            const collapseElements = document.querySelectorAll('.collapse');
            collapseElements.forEach(el => {
                new bootstrap.Collapse(el, { toggle: false });
            });
        });
    </script>
</body>
</html>