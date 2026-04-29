<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home | Digital E-Learning</title>
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
      font-size: 0.9rem;
    }

    /* Include all your CSS styles from courses page */
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
    
    .nav-links a.active::after {
      content: '';
      position: absolute;
      bottom: -6px;
      left: 0;
      width: 100%;
      height: 2px;
      background: var(--primary-color);
      border-radius: 2px;
    }
    
    .nav-right {
      display: flex;
      align-items: center;
      gap: 15px;
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
      border-color: var(--primary-color);
      box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.1);
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
    
    .login-btn {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border: none;
      padding: 6px 16px;
      border-radius: 18px;
      font-weight: 500;
      cursor: pointer;
      transition: transform 0.3s;
      white-space: nowrap;
      font-size: 0.85rem;
    }
    
    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);
    }

    .footer {
      background: var(--dark-color);
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: 50px;
      font-size: 0.85rem;
    }

    /* Homepage Specific Styles */
    .hero-section {
      background: linear-gradient(rgba(33, 150, 243, 0.8), rgba(110, 198, 255, 0.8)), 
                  url('https://plus.unsplash.com/premium_photo-1677567996070-68fa4181775a?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1172');
      color: white;
      padding: 80px 0;
      border-radius: 0 0 20px 20px;
      margin-bottom: 50px;
    }
    
    .hero-title {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 15px;
    }
    
    .hero-subtitle {
      font-size: 1.1rem;
      opacity: 0.9;
      max-width: 600px;
      margin: 0 auto 30px;
    }
    
    .cta-button {
      background: white;
      color: var(--primary-color);
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .cta-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(255, 255, 255, 0.2);
    }
    
    .features-section {
      padding: 50px 0;
    }
    
    .feature-card {
      background: white;
      border-radius: 12px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: transform 0.3s;
      height: 100%;
    }
    
    .feature-card:hover {
      transform: translateY(-5px);
    }
    
    .feature-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      color: white;
      font-size: 1.5rem;
    }
    
    .stats-section {
      background: white;
      padding: 50px 0;
      border-radius: 20px;
      margin: 50px 0;
    }
    
    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 5px;
    }
    
    .stat-label {
      color: #666;
      font-size: 0.9rem;
    }
    
     .system-logo {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }
    /* Guidelines Section Styles */
    .guidelines {
      padding: 50px 0;
    }
    
    .guide-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: transform 0.3s;
      height: 100%;
    }
    
    .guide-card:hover {
      transform: translateY(-5px);
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
              <li><a href="{{ url('/') }}" class="active">Home</a></li>
              <li><a href="{{ url('/courses') }}">Courses</a></li>
              <li><a href="{{ url('/guidelines') }}">Guidelines</a></li>
            </ul>
          </nav>
        </div>
        
        <div class="nav-right">
          <div class="search-bar">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search">
          </div>
          <button class="login-btn" onclick="window.location.href='{{ url('/login') }}'">Login</button>
        </div>
      </div>
    </div>
  </header>

  <!-- HERO SECTION -->
  <section class="hero-section">
    <div class="container text-center">
      <h1 class="hero-title">Welcome to Digital E-Learning</h1>
      <p class="hero-subtitle">Transform your learning experience with our comprehensive online courses. Gain knowledge, develop skills, and achieve your academic goals.</p>
      <button class="cta-button" onclick="window.location.href='{{ url('/courses') }}'">
        Explore Courses <i class="bi bi-arrow-right"></i>
      </button>
    </div>
  </section>

  <!-- FEATURES SECTION -->
  <section class="features-section">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="bi bi-laptop"></i>
            </div>
            <h4>Online Learning</h4>
            <p>Access courses from anywhere, anytime with our flexible online platform designed for modern learners.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="bi bi-mortarboard"></i>
            </div>
            <h4>Expert Instructors</h4>
            <p>Learn from experienced instructors and industry professionals dedicated to your success.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="bi bi-award"></i>
            </div>
            <h4>Quality Content</h4>
            <p>Engage with high-quality course materials, interactive content, and practical assignments.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Guidelines Section -->
  <section class="guidelines py-5 bg-light text-center">
    <div class="container">
      <h2 class="fw-bold mb-3">Guidelines & Resources</h2>
      <p class="text-muted mb-5">Everything you need to make the most of DEL.</p>

      <div class="row g-4">
        <div class="col-md-3">
          <div class="guide-card p-4">
            <i class="bi bi-person-video3 fa-2x text-primary mb-3"></i>
            <h5>Student Guidelines</h5>
            <p class="text-muted">Learn how to get started and progress effectively on the platform.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="guide-card p-4">
            <i class="bi bi-person-check fa-2x text-primary mb-3"></i>
            <h5>Teacher Guidelines</h5>
            <p class="text-muted">Tools, techniques, and best practices for effective online teaching.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="guide-card p-4">
            <i class="bi bi-journal-text fa-2x text-primary mb-3"></i>
            <h5>Content Guidelines</h5>
            <p class="text-muted">How to structure, upload, and manage your learning content.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="guide-card p-4">
            <i class="bi bi-headset fa-2x text-primary mb-3"></i>
            <h5>Need Help?</h5>
            <p class="text-muted mb-0">Reach us at <br><strong>del@daffodilvarsity.edu.bd</strong></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- STATS SECTION -->
  <section class="stats-section">
    <div class="container">
      <div class="row text-center">
        <div class="col-lg-3 col-md-6">
          <div class="stat-number">5000+</div>
          <div class="stat-label">Courses Available</div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stat-number">2,500+</div>
          <div class="stat-label">Students Enrolled</div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stat-number">25+</div>
          <div class="stat-label">Expert Instructors</div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stat-number">98%</div>
          <div class="stat-label">Satisfaction Rate</div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <p>© 2025 Digital E-Learning | All Rights Reserved</p>
    </div>
  </footer>

</body>
</html>