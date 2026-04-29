<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidelines | Digital E-Learning</title>
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

    /* Footer Styles */
    .footer {
      background: var(--dark-color);
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: 50px;
      font-size: 0.85rem;
    }

    .system-logo {
      width: 32px;
      height: 32px;
      object-fit: contain;
    }

    /* Guidelines Page Specific Styles */
    .page-header {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 60px 0 40px;
      border-radius: 0 0 20px 20px;
      margin-bottom: 40px;
    }
    
    .page-title {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 10px;
    }
    
    .page-subtitle {
      font-size: 1.1rem;
      opacity: 0.9;
      max-width: 800px;
      margin: 0 auto;
    }
    
    .guidelines-section {
      padding: 30px 0;
    }
    
    .guide-category {
      margin-bottom: 50px;
    }
    
    .category-title {
      color: var(--dark-color);
      font-weight: 700;
      margin-bottom: 25px;
      padding-bottom: 10px;
      border-bottom: 2px solid var(--primary-color);
    }
    
    .guide-card {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: all 0.3s;
      height: 100%;
      border-left: 4px solid var(--primary-color);
      margin-bottom: 20px;
    }
    
    .guide-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    
    .guide-card .icon {
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 15px;
      color: white;
      font-size: 1.2rem;
    }
    
    .guide-card h5 {
      color: var(--dark-color);
      font-weight: 600;
      margin-bottom: 10px;
    }
    
    .guide-card p {
      color: #666;
      font-size: 0.9rem;
      margin-bottom: 15px;
    }
    
    .steps-list {
      list-style-type: none;
      padding-left: 0;
      margin-bottom: 0;
    }
    
    .steps-list li {
      padding: 8px 0;
      border-bottom: 1px solid #eee;
      font-size: 0.9rem;
      color: #555;
    }
    
    .steps-list li:last-child {
      border-bottom: none;
    }
    
    .steps-list li i {
      color: var(--primary-color);
      margin-right: 10px;
    }
    
    .help-section {
      background: white;
      border-radius: 12px;
      padding: 30px;
      margin-top: 40px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      text-align: center;
    }
    
    .help-section h4 {
      color: var(--dark-color);
      margin-bottom: 20px;
    }
    
    .contact-info {
      font-size: 1.1rem;
      color: var(--primary-color);
      font-weight: 600;
    }
    
    .highlight-box {
      background: linear-gradient(135deg, #e3f2fd, #f3f9ff);
      border-radius: 12px;
      padding: 20px;
      margin: 20px 0;
      border-left: 4px solid var(--accent-color);
    }
    
    .download-btn {
      background: var(--primary-color);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 0.85rem;
      margin-top: 10px;
      transition: all 0.3s;
    }
    
    .download-btn:hover {
      background: var(--secondary-color);
      transform: translateY(-2px);
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
            <a href="<?php echo e(url('/')); ?>">Digital E-Learning</a>
          </li>
          
          <nav>
            <ul class="nav-links">
              <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
              <li><a href="<?php echo e(url('/courses')); ?>">Courses</a></li>
              <li><a href="<?php echo e(url('/guidelines')); ?>" class="active">Guidelines</a></li>
            </ul>
          </nav>
        </div>
        
        <div class="nav-right">
          <div class="search-bar">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search guidelines...">
          </div>
          <button class="login-btn" onclick="window.location.href='<?php echo e(url('/login')); ?>'">Login</button>
        </div>
      </div>
    </div>
  </header>

  <!-- PAGE HEADER -->
  <section class="page-header">
    <div class="container text-center">
      <h1 class="page-title">Guidelines & Resources</h1>
      <p class="page-subtitle">Everything you need to make the most of the Digital E-Learning platform. Find comprehensive guides for students, teachers, and content creators.</p>
    </div>
  </section>

  <!-- GUIDELINES CONTENT -->
  <section class="guidelines-section">
    <div class="container">
      <!-- Student Guidelines -->
      <div class="guide-category">
        <h2 class="category-title">
          <i class="bi bi-person-video3 me-2"></i>Student Guidelines
        </h2>
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="guide-card">
              <div class="icon">
                <i class="bi bi-person-plus"></i>
              </div>
              <h5>Getting Started</h5>
              <p>Learn how to set up your account and begin your learning journey.</p>
              <ul class="steps-list">
                <li><i class="bi bi-check-circle"></i> Create your student account</li>
                <li><i class="bi bi-check-circle"></i> Complete your profile information</li>
                <li><i class="bi bi-check-circle"></i> Browse and enroll in courses</li>
                <li><i class="bi bi-check-circle"></i> Set up your learning preferences</li>
              </ul>
            </div>
          </div>
          
          <div class="col-lg-6">
            <div class="guide-card">
              <div class="icon">
                <i class="bi bi-book"></i>
              </div>
              <h5>Course Navigation</h5>
              <p>How to effectively navigate and complete your courses.</p>
              <ul class="steps-list">
                <li><i class="bi bi-check-circle"></i> Access course materials and videos</li>
                <li><i class="bi bi-check-circle"></i> Submit assignments and projects</li>
                <li><i class="bi bi-check-circle"></i> Track your learning progress</li>
                <li><i class="bi bi-check-circle"></i> Participate in discussions and forums</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Teacher Guidelines -->
      <div class="guide-category">
        <h2 class="category-title">
          <i class="bi bi-person-check me-2"></i>Teacher Guidelines
        </h2>
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="guide-card">
              <div class="icon">
                <i class="bi bi-mortarboard"></i>
              </div>
              <h5>Course Creation</h5>
              <p>Steps to create and publish engaging online courses.</p>
              <ul class="steps-list">
                <li><i class="bi bi-check-circle"></i> Plan your course structure and objectives</li>
                <li><i class="bi bi-check-circle"></i> Upload course materials and resources</li>
                <li><i class="bi bi-check-circle"></i> Set up assessments and quizzes</li>
                <li><i class="bi bi-check-circle"></i> Publish and promote your course</li>
              </ul>
              <button class="download-btn"><i class="bi bi-download me-1"></i> Download Course Template</button>
            </div>
          </div>
          
          <div class="col-lg-6">
            <div class="guide-card">
              <div class="icon">
                <i class="bi bi-people"></i>
              </div>
              <h5>Student Engagement</h5>
              <p>Effective strategies to engage and support your students.</p>
              <ul class="steps-list">
                <li><i class="bi bi-check-circle"></i> Monitor student progress and performance</li>
                <li><i class="bi bi-check-circle"></i> Provide timely feedback on assignments</li>
                <li><i class="bi bi-check-circle"></i> Facilitate discussion forums</li>
                <li><i class="bi bi-check-circle"></i> Schedule live Q&A sessions</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Content Guidelines -->
      <div class="guide-category">
        <h2 class="category-title">
          <i class="bi bi-journal-text me-2"></i>Content Guidelines
        </h2>
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="guide-card">
              <div class="icon">
                <i class="bi bi-file-earmark-arrow-up"></i>
              </div>
              <h5>Content Standards</h5>
              <p>Quality standards for all learning materials on the platform.</p>
              <ul class="steps-list">
                <li><i class="bi bi-check-circle"></i> Ensure content is original and properly cited</li>
                <li><i class="bi bi-check-circle"></i> Maintain consistent formatting and structure</li>
                <li><i class="bi bi-check-circle"></i> Use accessible language and clear instructions</li>
                <li><i class="bi bi-check-circle"></i> Include diverse perspectives and examples</li>
              </ul>
            </div>
          </div>
          
          <div class="col-lg-6">
            <div class="guide-card">
              <div class="icon">
                <i class="bi bi-images"></i>
              </div>
              <h5>Multimedia Requirements</h5>
              <p>Technical specifications for videos, images, and other media.</p>
              <ul class="steps-list">
                <li><i class="bi bi-check-circle"></i> Video format: MP4, maximum 2GB per file</li>
                <li><i class="bi bi-check-circle"></i> Image format: JPG, PNG, or GIF</li>
                <li><i class="bi bi-check-circle"></i> Document format: PDF, DOCX, or PPTX</li>
                <li><i class="bi bi-check-circle"></i> Ensure all content is copyright compliant</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Policy Section -->
      <div class="highlight-box">
        <h4><i class="bi bi-shield-check me-2"></i>Platform Policies</h4>
        <p>All users must adhere to our community guidelines, copyright policies, and terms of service. Violations may result in content removal or account suspension.</p>
        <div class="d-flex gap-3 mt-3">
          <button class="download-btn"><i class="bi bi-file-text me-1"></i> Terms of Service</button>
          <button class="download-btn" style="background: var(--secondary-color);"><i class="bi bi-file-earmark-lock me-1"></i> Privacy Policy</button>
        </div>
      </div>
      
      <!-- Help Section -->
      <div class="help-section">
        <h4><i class="bi bi-headset me-2"></i>Need Additional Help?</h4>
        <p>If you have questions not covered in these guidelines, our support team is ready to assist you.</p>
        <p class="contact-info">
          <i class="bi bi-envelope me-2"></i>del@daffodilvarsity.edu.bd
        </p>
        <p class="contact-info">
          <i class="bi bi-telephone me-2"></i>+880 1234 567890
        </p>
        <p class="mt-3">Support Hours: Sunday-Thursday, 9:00 AM - 5:00 PM</p>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <p>© 2025 Digital E-Learning | All Rights Reserved</p>
    </div>
  </footer>

  <script>
    // Simple search functionality for guidelines
    document.querySelector('.search-bar input').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const guideCards = document.querySelectorAll('.guide-card');
      
      guideCards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(searchTerm) || searchTerm.length < 2) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
    
    // Simulate download button functionality
    document.querySelectorAll('.download-btn').forEach(button => {
      button.addEventListener('click', function() {
        const fileName = this.textContent.includes('Template') ? 'Course_Template.pdf' : 
                        this.textContent.includes('Terms') ? 'Terms_of_Service.pdf' : 
                        'Privacy_Policy.pdf';
        
        alert(`Downloading ${fileName}...`);
        // In a real implementation, this would trigger an actual download
      });
    });
  </script>
</body>
</html><?php /**PATH C:\Users\User\blc-elearning\resources\views/guidelines.blade.php ENDPATH**/ ?>