<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - Student Portal</title>
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

        /* Leaderboard Styles */
        .leaderboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .leaderboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .leaderboard-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .leaderboard-filters {
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

        .time-filter {
            display: flex;
            gap: 5px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .time-filter-btn {
            padding: 8px 15px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .time-filter-btn.active {
            background-color: #0369a1;
            color: white;
        }

        .time-filter-btn:hover:not(.active) {
            background-color: #f5f5f5;
        }

        /* Leaderboard Cards */
        .leaderboard-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card-leaderboard {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #0369a1;
            margin-bottom: 5px;
        }

        .stat-label-leaderboard {
            color: #666;
            font-size: 0.9rem;
        }

        /* Leaderboard Table */
        .leaderboard-table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .leaderboard-table {
            width: 100%;
            border-collapse: collapse;
        }

        .leaderboard-table thead {
            background-color: #f8fafc;
            border-bottom: 2px solid #e5e7eb;
        }

        .leaderboard-table th {
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .leaderboard-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.3s;
        }

        .leaderboard-table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .leaderboard-table tbody tr.current-user {
            background-color: #e8f4ff;
            font-weight: 600;
        }

        .leaderboard-table td {
            padding: 15px 20px;
            color: #555;
        }

        .rank-cell {
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            width: 70px;
        }

        .rank-1 .rank-cell {
            color: #ffd700;
        }

        .rank-2 .rank-cell {
            color: #c0c0c0;
        }

        .rank-3 .rank-cell {
            color: #cd7f32;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0f2fe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0369a1;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .user-info-cell {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: #333;
        }

        .user-email {
            font-size: 0.85rem;
            color: #777;
        }

        .score-cell {
            font-weight: bold;
            font-size: 1.1rem;
            color: #0369a1;
        }

        .badge-cell {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .badge {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .progress-cell {
            width: 200px;
        }

        .progress-bar-container {
            width: 100%;
            height: 8px;
            background-color: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background-color: #0369a1;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .progress-text {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
        }

        /* Pagination */
        .leaderboard-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
            padding: 20px;
        }

        .pagination-btn {
            padding: 8px 15px;
            border: 1px solid #ddd;
            background-color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .pagination-btn:hover:not(:disabled) {
            background-color: #f5f5f5;
            border-color: #0369a1;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-pages {
            display: flex;
            gap: 5px;
        }

        .page-number {
            padding: 8px 12px;
            border: 1px solid #ddd;
            background-color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .page-number:hover:not(.active) {
            background-color: #f5f5f5;
        }

        .page-number.active {
            background-color: #0369a1;
            color: white;
            border-color: #0369a1;
        }

        /* Empty State */
        .leaderboard-empty {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .leaderboard-empty i {
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
            .leaderboard-stats {
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

            .progress-cell {
                width: 150px;
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
            
            .leaderboard-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .leaderboard-filters {
                flex-direction: column;
                width: 100%;
            }
            
            .filter-dropdown, .time-filter {
                width: 100%;
            }
            
            .leaderboard-stats {
                grid-template-columns: 1fr;
            }

            .leaderboard-table {
                display: block;
                overflow-x: auto;
            }

            .progress-cell {
                width: 120px;
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

            .user-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .badge-cell {
                gap: 3px;
            }

            .badge {
                font-size: 0.7rem;
                padding: 2px 6px;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section (Same as Dashboard) -->
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
                            <a href="/">Digital E-Learning</a>
                        </li>
                        
                        <!-- Navigation Links -->
                        <li><a href="/">Home</a></li>
                        <li><a href="/student/dashboard">Dashboard</a></li>
                        <li><a href="/student/leaderboard" class="active">Leaderboard</a></li>
                    </ul>
                </nav>
            </div>
            
            <!-- Student Portal Centered -->
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="logo-text">Leaderboard</div>
            </div>
            
            <!-- Search, Notification, Profile on Right -->
            <div class="header-right">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Search students...">
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
                        <a href="#"><i class="fas fa-sign-out-alt"></i> Log out</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
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
                <a href="/student/dashboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                <a href="/student/courses"><i class="fas fa-book"></i> <span>All My Courses</span></a>
                <a href="/student/leaderboard" class="active"><i class="fas fa-trophy"></i> <span>Leaderboard</span></a>
                <a href="/student/events"><i class="fas fa-calendar-alt"></i> <span>Upcoming Events</span></a>
                
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <div class="leaderboard-container">
                <!-- Leaderboard Header -->
                <div class="leaderboard-header">
                    <h1 class="leaderboard-title">Student Leaderboard</h1>
                    <div class="leaderboard-filters">
                        <select class="filter-dropdown" id="course-filter">
                            <option value="all">All Courses</option>
                            <option value="math">Mathematics</option>
                            <option value="science">Science</option>
                            <option value="english">English</option>
                            <option value="history">History</option>
                        </select>
                        
                        <div class="time-filter">
                            <button class="time-filter-btn active" data-period="weekly">Weekly</button>
                            <button class="time-filter-btn" data-period="monthly">Monthly</button>
                            <button class="time-filter-btn" data-period="all-time">All Time</button>
                        </div>
                    </div>
                </div>
                
                <!-- Leaderboard Statistics -->
                <div class="leaderboard-stats">
                    <div class="stat-card-leaderboard">
                        <div class="stat-value">#8</div>
                        <div class="stat-label-leaderboard">Your Rank</div>
                    </div>
                    
                    <div class="stat-card-leaderboard">
                        <div class="stat-value">92%</div>
                        <div class="stat-label-leaderboard">Completion Rate</div>
                    </div>
                    
                    <div class="stat-card-leaderboard">
                        <div class="stat-value">28</div>
                        <div class="stat-label-leaderboard">Day Streak</div>
                    </div>
                    
                    <div class="stat-card-leaderboard">
                        <div class="stat-value">1,250</div>
                        <div class="stat-label-leaderboard">Total Points</div>
                    </div>
                </div>
                
                <!-- Leaderboard Table -->
                <div class="leaderboard-table-container">
                    <table class="leaderboard-table">
                        <thead>
                            <tr>
                                <th width="70">Rank</th>
                                <th>Student</th>
                                <th width="100">Score</th>
                                <th width="150">Completion</th>
                                <th width="100">Streak</th>
                                <th>Badges</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rank 1 -->
                            <tr class="rank-1">
                                <td class="rank-cell">1</td>
                                <td class="user-cell">
                                    <div class="user-avatar">SM</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">Sarah Miller</div>
                                        <div class="user-email">sarah.m@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">2,850</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 98%"></div>
                                    </div>
                                    <div class="progress-text">98% Complete</div>
                                </td>
                                <td>42 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Top Performer</span>
                                    <span class="badge">Perfect Score</span>
                                    <span class="badge">Early Bird</span>
                                </td>
                            </tr>
                            
                            <!-- Rank 2 -->
                            <tr class="rank-2">
                                <td class="rank-cell">2</td>
                                <td class="user-cell">
                                    <div class="user-avatar">JW</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">James Wilson</div>
                                        <div class="user-email">james.w@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">2,720</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 95%"></div>
                                    </div>
                                    <div class="progress-text">95% Complete</div>
                                </td>
                                <td>35 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Consistent</span>
                                    <span class="badge">Quiz Master</span>
                                </td>
                            </tr>
                            
                            <!-- Rank 3 -->
                            <tr class="rank-3">
                                <td class="rank-cell">3</td>
                                <td class="user-cell">
                                    <div class="user-avatar">EC</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">Emma Chen</div>
                                        <div class="user-email">emma.c@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">2,640</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 93%"></div>
                                    </div>
                                    <div class="progress-text">93% Complete</div>
                                </td>
                                <td>38 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Fast Learner</span>
                                    <span class="badge">Discussion Leader</span>
                                </td>
                            </tr>
                            
                            <!-- Ranks 4-7 -->
                            <tr>
                                <td class="rank-cell">4</td>
                                <td class="user-cell">
                                    <div class="user-avatar">RD</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">Robert Davis</div>
                                        <div class="user-email">robert.d@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">2,410</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 91%"></div>
                                    </div>
                                    <div class="progress-text">91% Complete</div>
                                </td>
                                <td>29 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Active Participant</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="rank-cell">5</td>
                                <td class="user-cell">
                                    <div class="user-avatar">LT</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">Lisa Thompson</div>
                                        <div class="user-email">lisa.t@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">2,380</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 90%"></div>
                                    </div>
                                    <div class="progress-text">90% Complete</div>
                                </td>
                                <td>31 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Team Player</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="rank-cell">6</td>
                                <td class="user-cell">
                                    <div class="user-avatar">MG</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">Michael Garcia</div>
                                        <div class="user-email">michael.g@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">2,210</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 89%"></div>
                                    </div>
                                    <div class="progress-text">89% Complete</div>
                                </td>
                                <td>26 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Problem Solver</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="rank-cell">7</td>
                                <td class="user-cell">
                                    <div class="user-avatar">AJ</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">Alex Johnson</div>
                                        <div class="user-email">alex.j@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">2,150</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 88%"></div>
                                    </div>
                                    <div class="progress-text">88% Complete</div>
                                </td>
                                <td>24 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Quick Thinker</span>
                                </td>
                            </tr>
                            
                            <!-- Current User (Rank 8) -->
                            <tr class="current-user">
                                <td class="rank-cell">8</td>
                                <td class="user-cell">
                                    <div class="user-avatar">JD</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">John Doe (You)</div>
                                        <div class="user-email">john.doe@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">1,250</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 92%"></div>
                                    </div>
                                    <div class="progress-text">92% Complete</div>
                                </td>
                                <td>28 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Regular Login</span>
                                    <span class="badge">Task Master</span>
                                </td>
                            </tr>
                            
                            <!-- Ranks 9-10 -->
                            <tr>
                                <td class="rank-cell">9</td>
                                <td class="user-cell">
                                    <div class="user-avatar">SW</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">Sophia White</div>
                                        <div class="user-email">sophia.w@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">1,980</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 87%"></div>
                                    </div>
                                    <div class="progress-text">87% Complete</div>
                                </td>
                                <td>22 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Creative Mind</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="rank-cell">10</td>
                                <td class="user-cell">
                                    <div class="user-avatar">KB</div>
                                    <div class="user-info-cell">
                                        <div class="user-name">Kevin Brown</div>
                                        <div class="user-email">kevin.b@example.com</div>
                                    </div>
                                </td>
                                <td class="score-cell">1,920</td>
                                <td class="progress-cell">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: 86%"></div>
                                    </div>
                                    <div class="progress-text">86% Complete</div>
                                </td>
                                <td>20 days</td>
                                <td class="badge-cell">
                                    <span class="badge">Dedicated</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="leaderboard-pagination">
                    <button class="pagination-btn" id="prev-page" disabled>
                        <i class="fas fa-chevron-left"></i> Previous
                    </button>
                    
                    <div class="pagination-pages">
                        <span class="page-number active">1</span>
                        <span class="page-number">2</span>
                        <span class="page-number">3</span>
                        <span class="page-number">4</span>
                        <span class="page-number">5</span>
                    </div>
                    
                    <button class="pagination-btn" id="next-page">
                        Next <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="max-w-7xl mx-auto px-4">
            <p>© 2025 Digital E-Learning Platform. All rights reserved.</p>
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

            // Time filter functionality
            const timeFilterBtns = document.querySelectorAll('.time-filter-btn');
            timeFilterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    timeFilterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    // In a real app, you would fetch new data based on the selected period
                    console.log('Filter changed to:', this.dataset.period);
                });
            });

            // Course filter functionality
            const courseFilter = document.getElementById('course-filter');
            if (courseFilter) {
                courseFilter.addEventListener('change', function() {
                    // In a real app, you would fetch new data based on the selected course
                    console.log('Course filter changed to:', this.value);
                });
            }

            // Search functionality
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase().trim();
                    const rows = document.querySelectorAll('.leaderboard-table tbody tr');
                    
                    rows.forEach(row => {
                        const userName = row.querySelector('.user-name').textContent.toLowerCase();
                        const userEmail = row.querySelector('.user-email').textContent.toLowerCase();
                        
                        if (userName.includes(searchTerm) || userEmail.includes(searchTerm) || searchTerm === '') {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            // Pagination functionality
            const prevPageBtn = document.getElementById('prev-page');
            const nextPageBtn = document.getElementById('next-page');
            const pageNumbers = document.querySelectorAll('.page-number');
            let currentPage = 1;

            if (prevPageBtn && nextPageBtn) {
                prevPageBtn.addEventListener('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        updatePagination();
                    }
                });

                nextPageBtn.addEventListener('click', function() {
                    if (currentPage < pageNumbers.length) {
                        currentPage++;
                        updatePagination();
                    }
                });
            }

            pageNumbers.forEach(page => {
                page.addEventListener('click', function() {
                    currentPage = parseInt(this.textContent);
                    updatePagination();
                });
            });

            function updatePagination() {
                // Update active page
                pageNumbers.forEach((page, index) => {
                    if (index + 1 === currentPage) {
                        page.classList.add('active');
                    } else {
                        page.classList.remove('active');
                    }
                });

                // Update button states
                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage === pageNumbers.length;

                // In a real app, you would fetch data for the new page
                console.log('Page changed to:', currentPage);
            }

            // Initialize with first page active
            updatePagination();
        });
    </script>
</body>
</html>