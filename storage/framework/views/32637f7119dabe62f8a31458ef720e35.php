<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard | Digital E-Learning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2196f3;
            --secondary-color: #6ec6ff;
            --accent-color: #ff6b6b;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
        }
        
        body {
            background: #f5f7fa;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        /* Header Styles */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 12px 0;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-image {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }
        
        .logo-text {
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--dark-color);
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: calc(100vh - 80px);
        }
        
        /* Sidebar */
        .sidebar {
            width: 280px;
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding: 25px 0;
        }
        
        .sidebar-header {
            padding: 0 25px 25px;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 20px;
        }
        
        .teacher-info h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
            color: var(--dark-color);
        }
        
        .teacher-info p {
            color: #666;
            margin: 5px 0 0;
            font-size: 0.9rem;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            color: #555;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(33, 150, 243, 0.1);
            color: var(--primary-color);
            border-right: 3px solid var(--primary-color);
        }
        
        .sidebar-menu i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        
        .welcome-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .welcome-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .welcome-subtitle {
            opacity: 0.9;
            font-size: 1rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-left: 4px solid var(--primary-color);
        }
        
        .stat-card.warning {
            border-left-color: var(--warning-color);
        }
        
        .stat-card.success {
            border-left-color: var(--success-color);
        }
        
        .stat-card.accent {
            border-left-color: var(--accent-color);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(33, 150, 243, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 1.3rem;
            color: var(--primary-color);
        }
        
        .stat-card.warning .stat-icon {
            background: rgba(255, 152, 0, 0.1);
            color: var(--warning-color);
        }
        
        .stat-card.success .stat-icon {
            background: rgba(76, 175, 80, 0.1);
            color: var(--success-color);
        }
        
        .stat-card.accent .stat-icon {
            background: rgba(255, 107, 107, 0.1);
            color: var(--accent-color);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Courses Section */
        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: between;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }
        
        .add-course-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
       

        /* Course Grid */
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .course-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .course-thumb {
            height: 160px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .course-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            color: #666;
        }
        
        .action-btn:hover {
            background: white;
            color: var(--primary-color);
            transform: scale(1.1);
        }
        
        .course-body {
            padding: 20px;
        }
        
        .course-category {
            background: rgba(33, 150, 243, 0.1);
            color: var(--primary-color);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 10px;
        }
        
        .course-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
            line-height: 1.4;
        }
        
        .course-meta {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }
        
        .course-progress {
            margin-bottom: 15px;
        }
        
        .progress-bar {
            height: 6px;
            background: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: var(--primary-color);
            border-radius: 3px;
        }
        
        .course-stats {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #666;
        }

        /* Analytics Section */
        .analytics-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .chart-card, .leaderboard-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .leaderboard-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .leaderboard-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .leaderboard-item:last-child {
            border-bottom: none;
        }
        
        .rank {
            width: 25px;
            height: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .student-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .student-info {
            flex: 1;
        }
        
        .student-name {
            font-weight: 500;
            color: var(--dark-color);
            font-size: 0.9rem;
        }
        
        .student-xp {
            color: #666;
            font-size: 0.8rem;
        }

        /* Achievements Section */
        .badges-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .badge-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
        }
        
        .badge-card:hover {
            transform: translateY(-3px);
        }
        
        .badge-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: white;
            font-size: 1.5rem;
        }
        
        .badge-name {
            font-weight: 500;
            color: var(--dark-color);
            font-size: 0.85rem;
            margin-bottom: 5px;
        }
        
        .badge-desc {
            color: #666;
            font-size: 0.75rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .analytics-grid {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                width: 250px;
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                order: 2;
            }
            
            .main-content {
                order: 1;
            }
            
            .course-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo-section">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" class="logo-image">
                    <div class="logo-text">Digital E-Learning</div>
                </div>
                
                <div class="user-menu">
                    <div class="dropdown">
                        <button class="btn btn-link text-dark text-decoration-none dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                            <img src="<?php echo e(Auth::user()->avatar ?? asset('images/default-avatar.png')); ?>" class="user-avatar me-2">
                            <span><?php echo e(Auth::user()->name); ?></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- DASHBOARD -->
    <div class="dashboard-container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="teacher-info">
                    <h3>Teacher Dashboard</h3>
                    <p>Manage your courses and students</p>
                </div>
            </div>
            
            <ul class="sidebar-menu">
                <li><a href="#" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li><a href="#"><i class="bi bi-journals"></i> My Courses</a></li>
                <li><a href="#"><i class="bi bi-people"></i> Students</a></li>
                <li><a href="#"><i class="bi bi-graph-up"></i> Analytics</a></li>
                <li><a href="#"><i class="bi bi-trophy"></i> Achievements</a></li>
                <li><a href="#"><i class="bi bi-clipboard-data"></i> Reports</a></li>
                <li><a href="#"><i class="bi bi-gear"></i> Settings</a></li>
            </ul>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1 class="welcome-title">Welcome back, <?php echo e(Auth::user()->name); ?>! 👋</h1>
                <p class="welcome-subtitle">Here's what's happening with your courses today.</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-journals"></i>
                    </div>
                    <div class="stat-number">8</div>
                    <div class="stat-label">Active Courses</div>
                </div>
                
                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-number">142</div>
                    <div class="stat-label">Total Students</div>
                </div>
                
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-number">89%</div>
                    <div class="stat-label">Completion Rate</div>
                </div>
                
                <div class="stat-card accent">
                    <div class="stat-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <div class="stat-number">23</div>
                    <div class="stat-label">Pending Reviews</div>
                </div>
            </div>

            <!-- My Courses Section -->
            <div class="section-header">
                <h2 class="section-title">My Courses</h2>
            </div>

            <div class="course-grid">
                <!-- Course 1 -->
                <div class="course-card">
                    <div class="course-thumb" style="background-image: url('https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                        <div class="course-actions">
                            <button class="action-btn" title="Edit Course"><i class="bi bi-pencil"></i></button>
                            <button class="action-btn" title="Delete Course"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <div class="course-body">
                        <span class="course-category">SWE</span>
                        <h3 class="course-title">Database Systems (Fall 2025)</h3>
                        <div class="course-meta">
                            <span><i class="bi bi-people"></i> 45 students</span>
                            <span><i class="bi bi-clock"></i> 16 lessons</span>
                        </div>
                        <div class="course-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 85%;"></div>
                            </div>
                        </div>
                        <div class="course-stats">
                            <span>85% completed</span>
                            <span>4.8★</span>
                        </div>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="course-card">
                    <div class="course-thumb" style="background-image: url('https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                        <div class="course-actions">
                            <button class="action-btn"><i class="bi bi-pencil"></i></button>
                            <button class="action-btn"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <div class="course-body">
                        <span class="course-category">CSE</span>
                        <h3 class="course-title">Web Development Fundamentals</h3>
                        <div class="course-meta">
                            <span><i class="bi bi-people"></i> 67 students</span>
                            <span><i class="bi bi-clock"></i> 24 lessons</span>
                        </div>
                        <div class="course-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 72%;"></div>
                            </div>
                        </div>
                        <div class="course-stats">
                            <span>72% completed</span>
                            <span>4.6★</span>
                        </div>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="course-card">
                    <div class="course-thumb" style="background-image: url('https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                        <div class="course-actions">
                            <button class="action-btn"><i class="bi bi-pencil"></i></button>
                            <button class="action-btn"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <div class="course-body">
                        <span class="course-category">MAT</span>
                        <h3 class="course-title">Data Structures & Algorithms</h3>
                        <div class="course-meta">
                            <span><i class="bi bi-people"></i> 38 students</span>
                            <span><i class="bi bi-clock"></i> 30 lessons</span>
                        </div>
                        <div class="course-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 91%;"></div>
                            </div>
                        </div>
                        <div class="course-stats">
                            <span>91% completed</span>
                            <span>4.9★</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics & Leaderboard -->
            <div class="analytics-grid">
                <div class="chart-card">
                    <h3 class="section-title">Student Progress Analytics</h3>
                    <div style="height: 300px; background: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #666;">
                        Progress Chart Visualization
                    </div>
                </div>
                
                <div class="leaderboard-card">
                    <h3 class="section-title">Top Students</h3>
                    <ul class="leaderboard-list">
                        <li class="leaderboard-item">
                            <div class="rank">1</div>
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="student-avatar">
                            <div class="student-info">
                                <div class="student-name">Sarah Johnson</div>
                                <div class="student-xp">1,450 XP</div>
                            </div>
                        </li>
                        <li class="leaderboard-item">
                            <div class="rank">2</div>
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="student-avatar">
                            <div class="student-info">
                                <div class="student-name">Michael Chen</div>
                                <div class="student-xp">1,320 XP</div>
                            </div>
                        </li>
                        <li class="leaderboard-item">
                            <div class="rank">3</div>
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="student-avatar">
                            <div class="student-info">
                                <div class="student-name">Emily Rodriguez</div>
                                <div class="student-xp">1,280 XP</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Achievements Section -->
            <h2 class="section-title">Teacher Achievements</h2>
            <div class="badges-grid">
                <div class="badge-card">
                    <div class="badge-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <div class="badge-name">Course Creator</div>
                    <div class="badge-desc">Created 5+ courses</div>
                </div>
                
                <div class="badge-card">
                    <div class="badge-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="badge-name">Mentor</div>
                    <div class="badge-desc">100+ students taught</div>
                </div>
                
                <div class="badge-card">
                    <div class="badge-icon">
                        <i class="bi bi-lightning"></i>
                    </div>
                    <div class="badge-name">Quick Grader</div>
                    <div class="badge-desc">Grade assignments in 24h</div>
                </div>
                
                <div class="badge-card">
                    <div class="badge-icon">
                        <i class="bi bi-award"></i>
                    </div>
                    <div class="badge-name">Top Rated</div>
                    <div class="badge-desc">4.8+ average rating</div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\User\blc-elearning\resources\views/dashboard.blade.php ENDPATH**/ ?>