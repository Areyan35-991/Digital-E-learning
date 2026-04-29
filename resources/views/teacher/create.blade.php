<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Lesson to {{ $course->title }} | Digital E-Learning</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #2196f3;
      --secondary-color: #6ec6ff;
      --accent-color: #ff6b6b;
      --dark-color: #2c3e50;
      --light-color: #f8f9fa;
    }
    
    body {
      background: linear-gradient(135deg, #d8edff, #f2f9ff);
      font-family: 'Poppins', sans-serif;
      color: #333;
      min-height: 100vh;
    }

    /* Include all your header/footer styles */
    .header {
      background: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 10px 0;
    }
    
    .logo-section {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .logo-icon {
      width: 35px;
      height: 35px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
      font-size: 0.9rem;
    }
    
    .logo-text {
      font-weight: 700;
      font-size: 1.2rem;
      color: var(--dark-color);
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
      position: relative;
      font-size: 0.9rem;
    }
    
    .nav-links a:hover {
      color: var(--primary-color);
    }
    
    .nav-links a.active {
      color: var(--primary-color);
      font-weight: 600;
    }
    
    .nav-right {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .user-menu {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
    }
    
    .user-avatar {
      width: 35px;
      height: 35px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 600;
      font-size: 0.9rem;
    }
    
    .user-name {
      font-weight: 500;
      color: var(--dark-color);
      font-size: 0.9rem;
    }

    /* Form Styles */
    .form-container {
      padding: 30px 0;
    }
    
    .form-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    
    .form-title {
      font-weight: 700;
      color: var(--dark-color);
      margin-bottom: 25px;
      font-size: 1.5rem;
    }
    
    .form-label {
      font-weight: 500;
      color: var(--dark-color);
      margin-bottom: 8px;
    }
    
    .form-control {
      border: 2px solid #e9ecef;
      border-radius: 8px;
      padding: 12px;
      transition: all 0.3s;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }
    
    .btn-instructor {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s;
    }
    
    .btn-instructor:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
    }
    
    .btn-outline-instructor {
      background: transparent;
      color: var(--primary-color);
      border: 2px solid var(--primary-color);
      padding: 12px 30px;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s;
    }
    
    .btn-outline-instructor:hover {
      background: var(--primary-color);
      color: white;
    }
    
    .form-check-input:checked {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .footer {
      background: var(--dark-color);
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: 50px;
      font-size: 0.85rem;
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div class="container">
      <div class="nav-container">
        <div class="nav-left">
          <div class="logo-section">
            <div class="logo-icon">
              <i class="bi bi-book-half"></i>
            </div>
            <div class="logo-text">Digital E-Learning</div>
          </div>
          
          <nav>
            <ul class="nav-links">
              <li><a href="{{ url('/') }}">Home</a></li>
              <li><a href="{{ url('/courses') }}">Courses</a></li>
              <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
              <li><a href="{{ url('/instructor/courses') }}" class="active">Instructor</a></li>
              <li><a href="{{ url('/guidelines') }}">Guidelines</a></li>
            </ul>
          </nav>
        </div>
        
        <div class="nav-right">
          <div class="user-menu">
            <div class="user-avatar">
              {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="user-name">{{ auth()->user()->name }}</div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- FORM CONTENT -->
  <div class="form-container">
    <div class="container">
      <div class="form-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="form-title">Add New Lesson</h1>
          <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn-outline-instructor">
            <i class="bi bi-arrow-left"></i> Back to Course
          </a>
        </div>

        <form action="{{ route('teacher.contents.store', $course->id) }}" method="POST" enctype="multipart/form-data"></form>
          @csrf
          
          <div class="row">
            <div class="col-md-8">
              <div class="mb-3">
                <label for="title" class="form-label">Lesson Title *</label>
                <input type="text" class="form-control" id="title" name="title" required 
                       placeholder="Enter lesson title" value="{{ old('title') }}">
              </div>

              <div class="mb-3">
                <label for="content" class="form-label">Lesson Content *</label>
                <textarea class="form-control" id="content" name="content" rows="12" required 
                          placeholder="Enter the lesson content here...">{{ old('content') }}</textarea>
              </div>
            </div>

            <div class="col-md-4">
              <div class="mb-3">
                <label for="order" class="form-label">Lesson Order *</label>
                <input type="number" class="form-control" id="order" name="order" required 
                       min="1" value="{{ old('order', $course->lessons + 1) }}">
                <div class="form-text">The sequence number of this lesson in the course</div>
              </div>

              <div class="mb-3">
                <label for="duration" class="form-label">Duration (minutes) *</label>
                <input type="number" class="form-control" id="duration" name="duration" required 
                       min="1" value="{{ old('duration') }}" placeholder="e.g., 30">
              </div>

              <div class="mb-3">
                <label for="video_url" class="form-label">Video URL (Optional)</label>
                <input type="url" class="form-control" id="video_url" name="video_url" 
                       placeholder="https://youtube.com/embed/..." value="{{ old('video_url') }}">
                <div class="form-text">Embed URL for YouTube, Vimeo, etc.</div>
              </div>

              <div class="mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="is_published" name="is_published" 
                         {{ old('is_published') ? 'checked' : '' }}>
                  <label class="form-check-label" for="is_published">
                    Publish this lesson immediately
                  </label>
                </div>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn-instructor">
                  <i class="bi bi-plus-circle"></i> Create Lesson
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <p>© 2025 Digital E-Learning | Empowering learners worldwide</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>