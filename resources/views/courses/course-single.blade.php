<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $course->title }} | Digital E-Learning</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #2196f3;
      --secondary-color: #6ec6ff;
      --dark-color: #2c3e50;
    }
    
    body {
      background: #f8f9fa;
      font-family: 'Poppins', sans-serif;
      color: #333;
      min-height: 100vh;
    }

    /* Header Styles */
    .header {
      background: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 10px 0;
    }
    
      .system-name {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-right: 20px;
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
    
  
    .system-logo {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }
    
    .nav-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }
    
    .nav-left {
      display: flex;
      align-items: center;
      gap: 25px;
    }
    
    .nav-links {
      display: flex;
      gap: 20px;
      list-style: none;
      margin: 0;
      padding: 0;
    }
    
    .nav-links a {
      text-decoration: none;
      color: #555;
      font-weight: 500;
      transition: color 0.3s;
      font-size: 0.9rem;
    }
    
    .nav-links a:hover {
      color: var(--primary-color);
    }
    
    .nav-right {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .login-btn {
      background: transparent;
      color: var(--primary-color);
      border: 2px solid var(--primary-color);
      padding: 6px 16px;
      border-radius: 18px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
      display: inline-block;
    }
    
    .login-btn:hover {
      background: var(--primary-color);
      color: white;
    }

    /* Main Content */
    .course-content {
      max-width: 1200px;
      margin: 0 auto;
      padding: 30px 20px;
    }

    /* Course Header */
    .course-header {
      background: white;
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 25px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    
    .course-title {
      font-size: 2.2rem;
      font-weight: 700;
      color: var(--dark-color);
      margin-bottom: 25px;
    }
    
    .instructor-section {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 15px;
    }
    
    .instructor-avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #e9ecef;
    }
    
    .instructor-info h4 {
      font-size: 1rem;
      font-weight: 600;
      margin: 0;
      color: var(--dark-color);
    }
    
    .instructor-info p {
      font-size: 0.9rem;
      color: #666;
      margin: 0;
    }
    
    .category-section {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .category-badge {
      background: #e3f2fd;
      color: var(--primary-color);
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 500;
    }

    /* Navigation Tabs */
    .course-tabs {
      background: white;
      border-radius: 12px;
      padding: 0 30px;
      margin-bottom: 25px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    
    .nav-tabs {
      border: none;
      gap: 30px;
    }
    
    .nav-tabs .nav-link {
      border: none;
      color: #666;
      font-weight: 500;
      padding: 15px 0;
      position: relative;
      background: transparent;
      font-size: 0.95rem;
    }
    
    .nav-tabs .nav-link.active {
      color: var(--primary-color);
      background: transparent;
      font-weight: 600;
    }
    
    .nav-tabs .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--primary-color);
      border-radius: 3px 3px 0 0;
    }

    /* Course Overview */
    .course-overview-section {
      background: white;
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 25px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    
    .section-title {
      font-size: 1.4rem;
      font-weight: 600;
      color: var(--dark-color);
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid #e9ecef;
    }
    
    .course-description {
      line-height: 1.7;
      color: #555;
      font-size: 0.95rem;
    }
    
    .course-description p {
      margin-bottom: 15px;
    }

    /* Enrollment Section */
    .enrollment-section {
      background: white;
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 25px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    
    .enrollment-header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }
    
    .enrollment-header h3 {
      font-size: 1.4rem;
      font-weight: 600;
      color: var(--dark-color);
      margin: 0;
    }
    
    .course-name-line {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 25px;
      padding: 15px;
      background: #f8f9fa;
      border-radius: 8px;
      border-left: 4px solid var(--primary-color);
    }
    
    .course-name-line strong {
      font-size: 1.1rem;
      color: var(--dark-color);
    }
    
    .enrollment-option {
      background: #f8f9fa;
      border-radius: 8px;
      padding: 25px;
      border: 1px solid #e9ecef;
    }
    
    .enrollment-subtitle {
      font-weight: 600;
      color: var(--dark-color);
      margin-bottom: 20px;
      font-size: 1.1rem;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--dark-color);
      font-size: 0.9rem;
    }
    
    .form-control {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 0.9rem;
      transition: all 0.3s;
      max-width: 400px;
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }
    
    .enroll-submit {
      background: var(--primary-color);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      font-size: 0.9rem;
    }
    
    .enroll-submit:hover {
      background: #1976d2;
      transform: translateY(-1px);
    }

    /* Sidebar Card */
    .sidebar-card {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
      position: sticky;
      top: 20px;
    }
    
    .course-price {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--primary-color);
      text-align: center;
      margin-bottom: 20px;
    }
    
    .enroll-btn {
      width: 100%;
      background: var(--primary-color);
      color: white;
      border: none;
      padding: 15px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      margin-bottom: 25px;
      font-size: 1rem;
    }
    
    .enroll-btn:hover {
      background: #1976d2;
      transform: translateY(-2px);
    }
    
    .course-meta-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .course-meta-list li {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #f0f0f0;
      color: #666;
      font-size: 0.9rem;
    }
    
    .course-meta-list li:last-child {
      border-bottom: none;
    }
    
    .meta-label {
      font-weight: 500;
      color: var(--dark-color);
    }

    /* Footer */
    .footer {
      background: var(--dark-color);
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 0.85rem;
      margin-top: 50px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .course-title {
        font-size: 1.8rem;
      }
      
      .instructor-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      
      .nav-tabs {
        gap: 15px;
      }
      
      .sidebar-card {
        position: static;
        margin-top: 25px;
      }
    }

    /* Message Alerts */
    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 0.9rem;
    }
    
    .alert-success {
      background: #d4edda;
      border: 1px solid #c3e6cb;
      color: #155724;
    }
    
    .alert-danger {
      background: #f8d7da;
      border: 1px solid #f5c6cb;
      color: #721c24;
    }
    
    .alert-info {
      background: #d1ecf1;
      border: 1px solid #bee5eb;
      color: #0c5460;
    }
    
    .alert-warning {
      background: #fff3cd;
      border: 1px solid #ffeaa7;
      color: #856404;
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div class="container">
      <div class="nav-container">
        <div class="nav-left">
            
             <li class="system-name">
                   <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Digital E-Learning Logo" class="system-logo">
                    <a href="{{ url('/') }}">Digital E-Learning</a>
             </li>
                    
          <nav>
            <ul class="nav-links">
              <li><a href="{{ url('/') }}">Home</a></li>
              <li><a href="{{ url('/courses') }}">Courses</a></li>
              <li><a href="{{ url('/guidelines') }}">Guidelines</a></li>
            </ul>
          </nav>
        </div>
        
        <!-- User Status -->
        <div class="nav-right">
          @auth
            <div class="user-status">
              <span style="color: var(--dark-color); font-size: 0.9rem;">
                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
              </span>
              @if(Auth::user()->role === 'student')
                <span class="badge bg-success ms-2">Student</span>
              @elseif(Auth::user()->role === 'teacher')
                <span class="badge bg-primary ms-2">Teacher</span>
              @endif
            </div>
          @else
            <a href="{{ route('login') }}" class="login-btn">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
          @endauth
        </div>
      </div>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <div class="course-content">
    <!-- Display Messages -->
    @if(session('success'))
      <div class="alert alert-success">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
      </div>
    @endif
    
    @if(session('error'))
      <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
      </div>
    @endif
    
    @if(session('info'))
      <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> {{ session('info') }}
      </div>
    @endif

    <div class="row">
      <!-- Left Column - Main Content -->
      <div class="col-lg-8">
        <!-- Course Header -->
        <div class="course-header">
          <h1 class="course-title">{{ $course->title }}</h1>
          
          <div class="instructor-section">
            @if($course->instructor)
              <img src="{{ asset('images/default-avatar.png') }}" 
                   alt="{{ $course->instructor }}" class="instructor-avatar">
              <div class="instructor-info">
                <h4>Instructor</h4>
                <p>{{ $course->instructor }}</p>
              </div>
            @else
              <img src="{{ asset('images/default-avatar.png') }}" 
                   alt="Instructor" class="instructor-avatar">
              <div class="instructor-info">
                <h4>Instructor</h4>
                <p>To be assigned</p>
              </div>
            @endif
          </div>
          
          <div class="category-section">
            <div class="instructor-info">
              <h4>Category</h4>
              <div class="category-badge">{{ $course->category }}</div>
            </div>
          </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="course-tabs">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#">Course Overview</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Course Content</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Instructors</a>
            </li>
          </ul>
        </div>

        <!-- Course Overview -->
        <div class="course-overview-section">
          <h3 class="section-title">Course Overview</h3>
          <div class="course-description">
            {!! $course->description !!}
          </div>
        </div>

        <!-- Enrollment Status Display -->
        @auth
          @if(Auth::user()->role === 'student')
            @php
              $isEnrolled = Auth::user()->enrollments()->where('course_id', $course->id)->exists();
            @endphp
            
            @if($isEnrolled)
              <div class="enrollment-section">
                <div class="alert alert-success">
                  <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-3" style="font-size: 1.5rem;"></i>
                    <div>
                      <h5 class="mb-1">You are enrolled in this course!</h5>
                      <p class="mb-0">Access course materials and start learning.</p>
                    </div>
                  </div>
                  <div class="mt-3">
                    <a href="{{ route('student.courses.show', $course->id) }}" class="enroll-submit">
                      <i class="bi bi-play-circle"></i> Go to Course
                    </a>
                  </div>
                </div>
              </div>
            @endif
          @endif
        @endauth

        <!-- Enrollment Options -->
        <div class="enrollment-section">
          <div class="enrollment-header">
            <h3>Enrolment options</h3>
          </div>
          
          <div class="course-name-line">
            <i class="bi bi-shield-check text-primary"></i>
            <strong>{{ $course->title }}</strong>
          </div>
          
          <div class="enrollment-option">
            <h5 class="enrollment-subtitle">Self enrolment (Student)</h5>
            
            @auth
              @if(Auth::user()->role === 'student')
                @if(!$isEnrolled ?? false)
                  <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                    @csrf
                    
                    @if($course->enrollment_key)
                      <div class="form-group">
                        <label class="form-label">Enrolment key</label>
                        <input type="password" 
                               name="enrollment_key" 
                               class="form-control" 
                               placeholder="Enter enrolment key"
                               required>
                        <small class="text-muted">Ask your instructor for the enrolment key</small>
                      </div>
                    @endif
                    
                    <button type="submit" class="enroll-submit">
                      <i class="bi bi-lock"></i> Enrol me
                    </button>
                  </form>
                @else
                  <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> You are already enrolled in this course.
                  </div>
                @endif
              @else
                <div class="alert alert-warning">
                  <i class="bi bi-exclamation-triangle"></i> Only students can enroll in courses.
                </div>
              @endif
            @else
              <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Please <a href="{{ route('login') }}">sign in</a> as a student to enroll in this course.
              </div>
            @endauth
          </div>
        </div>
      </div>
      
      <!-- Right Column - Sidebar -->
      <div class="col-lg-4">
        <div class="sidebar-card">
          <div class="course-price">FREE</div>
          
          @auth
            @if(Auth::user()->role === 'student')
              @if(!$isEnrolled ?? false)
                <form action="{{ route('courses.enroll', $course->id) }}" method="POST" id="sidebar-enroll-form">
                  @csrf
                  
                  @if($course->enrollment_key)
                    <div class="form-group mb-3">
                      <label class="form-label">Enrolment key</label>
                      <input type="password" 
                             name="enrollment_key" 
                             class="form-control" 
                             placeholder="Enter enrolment key"
                             required>
                    </div>
                  @endif
                  
                  <button type="submit" class="enroll-btn">
                    <i class="bi bi-cart-plus"></i> Enrol Now
                  </button>
                </form>
              @else
                <div class="alert alert-success mb-3">
                  <i class="bi bi-check-circle"></i> Enrolled
                </div>
                <a href="{{ route('student.courses.show', $course->id) }}" class="enroll-btn" style="text-decoration: none; display: block; text-align: center;">
                  <i class="bi bi-play-circle"></i> Continue Learning
                </a>
              @endif
            @else
              <div class="alert alert-warning mb-3">
                <i class="bi bi-exclamation-triangle"></i> Only students can enroll
              </div>
            @endif
          @else
            <a href="{{ route('login') }}" class="enroll-btn" style="text-decoration: none; display: block; text-align: center;">
              <i class="bi bi-cart-plus"></i> Enrol Now
            </a>
          @endauth
          
          <ul class="course-meta-list">
            <li>
              <span class="meta-label">Updated</span>
              <span>{{ $course->updated_at->format('d M Y') }}</span>
            </li>
            <li>
              <span class="meta-label">Lessons</span>
              <span>{{ $course->lessons }}</span>
            </li>
            <li>
              <span class="meta-label">Enrolled</span>
              <span>{{ $course->enrolled_count }}</span>
            </li>
            <li>
              <span class="meta-label">Language</span>
              <span>{{ $course->language }}</span>
            </li>
            <li>
              <span class="meta-label">Skill Level</span>
              <span>{{ $course->skill_level }}</span>
            </li>
            <li>
              <span class="meta-label">Semester</span>
              <span>{{ $course->semester }}</span>
            </li>
            <li>
              <span class="meta-label">Duration</span>
              <span>{{ $course->duration_weeks }} weeks</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <p>© 2025 Digital E-Learning | All Rights Reserved</p>
    </div>
  </footer>

  <script>
    // Tab functionality
    document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
      tab.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all tabs
        document.querySelectorAll('.nav-tabs .nav-link').forEach(t => {
          t.classList.remove('active');
        });
        
        // Add active class to clicked tab
        this.classList.add('active');
      });
    });

    // Sync enrollment key between both forms
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarForm = document.getElementById('sidebar-enroll-form');
      const mainForm = document.querySelector('.enrollment-option form');
      
      if (sidebarForm && mainForm) {
        const sidebarKeyInput = sidebarForm.querySelector('input[name="enrollment_key"]');
        const mainKeyInput = mainForm.querySelector('input[name="enrollment_key"]');
        
        if (sidebarKeyInput && mainKeyInput) {
          // Sync from sidebar to main
          sidebarKeyInput.addEventListener('input', function() {
            mainKeyInput.value = this.value;
          });
          
          // Sync from main to sidebar
          mainKeyInput.addEventListener('input', function() {
            sidebarKeyInput.value = this.value;
          });
        }
      }
    });
  </script>

</body>
</html>