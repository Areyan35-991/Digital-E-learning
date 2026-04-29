<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All Courses | Digital E-Learning</title>
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

    /* Hero Section */
    .hero-section {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 30px 0;
      border-radius: 0 0 20px 20px;
      margin-bottom: 30px;
    }
    
    .hero-title {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 8px;
    }
    
    .hero-subtitle {
      font-size: 0.95rem;
      opacity: 0.9;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Course Card */
    .course-card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      background: white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s, box-shadow 0.3s;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    
    .course-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }
    
    .course-thumb {
      height: 140px;
      background-size: cover;
      background-position: center;
      position: relative;
    }
    
    .course-thumb::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 40%;
      background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
    }
    
    .course-body {
      flex: 1;
      padding: 16px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    
    .badge {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      font-size: 0.7rem;
      padding: 4px 8px;
      border-radius: 12px;
    }
    
    .course-title {
      font-weight: 600;
      margin: 8px 0;
      line-height: 1.3;
      color: var(--dark-color);
      font-size: 0.9rem;
    }
    
    .instructor {
      color: #666;
      font-size: 0.8rem;
      margin-bottom: 12px;
    }
    
    .course-meta {
      display: flex;
      justify-content: space-between;
      font-size: 0.75rem;
      color: #777;
      margin-bottom: 12px;
    }
    
    .view-course-btn {
      background: transparent;
      color: var(--primary-color);
      border: 1px solid var(--primary-color);
      padding: 6px 12px;
      border-radius: 16px;
      font-weight: 500;
      transition: all 0.3s;
      text-align: center;
      text-decoration: none;
      font-size: 0.8rem;
    }
    
    .view-course-btn:hover {
      background: var(--primary-color);
      color: white;
      transform: translateY(-1px);
    }

    /* Search Section */
    .search-section {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      padding: 16px;
      margin-bottom: 25px;
    }
    
    .search-container {
      display: flex;
      gap: 12px;
      align-items: center;
    }
    
    .search-input {
      flex: 1;
      position: relative;
    }
    
    .search-input input {
      width: 100%;
      padding: 10px 16px 10px 40px;
      border: 1px solid #ddd;
      border-radius: 20px;
      font-size: 0.9rem;
      transition: all 0.3s;
    }
    
    .search-input input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.1);
    }
    
    .search-input i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #777;
      font-size: 0.9rem;
    }
    
    .filter-btn {
      background: white;
      border: 1px solid #ddd;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: 500;
      transition: all 0.3s;
      font-size: 0.85rem;
    }
    
    .filter-btn:hover {
      border-color: var(--primary-color);
      color: var(--primary-color);
    }

    /* Section Title */
    .section-title {
      font-weight: 700;
      color: var(--dark-color);
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 8px;
      font-size: 1.3rem;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 2px;
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
      border-radius: 2px;
    }

    /* Footer */
    .footer {
      background: var(--dark-color);
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: 50px;
      font-size: 0.85rem;
    }
    
    .footer p {
      margin: 0;
      opacity: 0.8;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
      .nav-container {
        flex-direction: column;
        gap: 12px;
      }
      
      .nav-left {
        width: 100%;
        justify-content: space-between;
      }
      
      .nav-right {
        width: 100%;
        justify-content: space-between;
      }
      
      .search-bar {
        margin-right: 0;
        flex: 1;
        max-width: 250px;
      }
      
      .search-bar input {
        width: 100%;
      }

      .hero-title {
        font-size: 1.7rem;
      }

      .hero-subtitle {
        font-size: 0.9rem;
      }
    }
    
    @media (max-width: 768px) {
      .nav-links {
        gap: 15px;
      }
      
      .search-bar input {
        width: 180px;
      }
      
      .search-bar input:focus {
        width: 220px;
      }
      
      .hero-title {
        font-size: 1.5rem;
      }

      .hero-subtitle {
        font-size: 0.85rem;
      }

      .search-container {
        flex-direction: column;
      }
      
      .filter-btn {
        align-self: flex-start;
      }
      
      .nav-right {
        flex-wrap: wrap;
        gap: 10px;
      }

      .section-title {
        font-size: 1.2rem;
      }
    }
    
    @media (max-width: 576px) {
      .nav-links {
        flex-direction: column;
        gap: 8px;
      }
      
      .nav-links a {
        font-size: 0.85rem;
      }
      
      .nav-left {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }
      
      .search-bar {
        max-width: 100%;
      }
      
      .search-bar input {
        width: 100%;
        font-size: 0.8rem;
      }

      .login-btn {
        font-size: 0.8rem;
        padding: 5px 12px;
      }

      .hero-title {
        font-size: 1.3rem;
      }

      .hero-subtitle {
        font-size: 0.8rem;
      }

      .course-title {
        font-size: 0.85rem;
      }

      .instructor {
        font-size: 0.75rem;
      }

      .section-title {
        font-size: 1.1rem;
      }
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
              <li><a href="<?php echo e(url('/courses')); ?>" class="active">Courses</a></li>
              <li><a href="<?php echo e(url('/guidelines')); ?>">Guidelines</a></li>
            </ul>
          </nav>
        </div>
        
        <div class="nav-right">
          <div class="search-bar">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search">
          </div>
          <button class="login-btn" onclick="window.location.href='<?php echo e(url('/login')); ?>'">Login</button>
        </div>
      </div>
    </div>
  </header>

  <!-- HERO SECTION -->
  <section class="hero-section">
    <div class="container text-center">
      <h1 class="hero-title">Explore Our Courses</h1>
      <p class="hero-subtitle">Discover a wide range of academic courses designed to enhance your knowledge and skills. Find the perfect course for your educational journey.</p>
    </div>
  </section>

  <!-- SEARCH & FILTER SECTION -->
  <div class="container">
    <div class="search-section">
      <div class="search-container">
        <div class="search-input">
          <i class="bi bi-search"></i>
          <input type="text" placeholder="Search courses by title, instructor, or subject..." id="searchInput">
        </div>
        <button class="filter-btn">
          <i class="bi bi-funnel"></i> Filters
        </button>
      </div>
    </div>
  </div>

  <!-- COURSE GRID -->
  <div class="container pb-5">
    <h3 class="section-title">Available Courses</h3>
    <div class="row g-4" id="courseList">
      <!-- Courses will be loaded here -->
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <p>© 2025 Digital E-Learning | All Rights Reserved</p>
    </div>
  </footer>

  <script>
    // Get courses data from Laravel - safely handle undefined
    const courses = <?php echo json_encode($courses ?? [], 15, 512) ?>;
    
    console.log('Courses data:', courses); // Debug log

    const list = document.getElementById("courseList");
    const searchInput = document.getElementById("searchInput");

    const renderCourses = (filter = "") => {
      list.innerHTML = "";
      
      // If no courses, show message
      if (!courses || courses.length === 0) {
        list.innerHTML = `
          <div class="col-12 text-center py-5">
            <i class="bi bi-exclamation-circle" style="font-size: 2.5rem; color: #ccc;"></i>
            <h4 class="mt-3" style="font-size: 1.1rem;">No courses available</h4>
            <p class="text-muted" style="font-size: 0.85rem;">Check back later for new courses</p>
          </div>
        `;
        return;
      }

      const filteredCourses = courses.filter(c => 
        c.title.toLowerCase().includes(filter.toLowerCase()) || 
        (c.instructor && c.instructor.toLowerCase().includes(filter.toLowerCase()))
      );
      
      if (filteredCourses.length === 0) {
        list.innerHTML = `
          <div class="col-12 text-center py-5">
            <i class="bi bi-search" style="font-size: 2.5rem; color: #ccc;"></i>
            <h4 class="mt-3" style="font-size: 1.1rem;">No courses found</h4>
            <p class="text-muted" style="font-size: 0.85rem;">Try adjusting your search terms</p>
          </div>
        `;
        return;
      }
      
      filteredCourses.forEach(c => {
        const courseImage = c.image || 'https://cdn.pixabay.com/photo/2017/08/06/15/13/database-2596017_1280.png';
        
        // Use course ID for the link to single course view
        const courseLink = `/course/${c.id}`;
        
        list.innerHTML += 
          `<div class="col-lg-3 col-md-4 col-sm-6 d-flex">
            <div class="course-card w-100">
              <div class="course-thumb" style="background-image: url('${courseImage}');"></div>
              <div class="course-body">
                <div>
                  <span class="badge">${c.category || 'Academic'}</span>
                  <h6 class="course-title">${c.title}</h6>
                  ${c.instructor ? `<p class="instructor"><i class="bi bi-person"></i> ${c.instructor}</p>` : ''}
                  <div class="course-meta">
                    <span><i class="bi bi-clock"></i> ${c.duration_weeks || '12'} weeks</span>
                    <span><i class="bi bi-people"></i> ${c.enrolled_count || '0'} enrolled</span>
                  </div>
                </div>
                <a href="${courseLink}" class="view-course-btn">View Course</a>
              </div>
            </div>
          </div>`;
      });
    };

    renderCourses();
    searchInput.addEventListener("input", e => renderCourses(e.target.value));
</script>

</body>
</html><?php /**PATH C:\Users\User\blc-elearning\resources\views/courses/index.blade.php ENDPATH**/ ?>