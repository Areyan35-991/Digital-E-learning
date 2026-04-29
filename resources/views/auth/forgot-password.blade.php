<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password | Digital E-Learning</title>
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
      display: flex;
      flex-direction: column;
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
    
    .register-btn {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border: none;
      padding: 8px 20px;
      border-radius: 20px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
      display: inline-block;
    }
    
    .register-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(33, 150, 243, 0.3);
      color: white;
    }

    /* Auth Container */
    .auth-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 80px 20px 60px;
      background: linear-gradient(135deg, #d8edff, #f2f9ff);
    }
    
    .auth-wrapper {
      display: flex;
      max-width: 1000px;
      width: 100%;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      min-height: 600px;
    }
    
    .auth-hero {
      flex: 1;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }
    
    .auth-hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 200%;
      background: rgba(255, 255, 255, 0.1);
      transform: rotate(45deg);
    }
    
    .auth-hero-content {
      position: relative;
      z-index: 2;
    }
    
    .hero-icon {
      font-size: 4rem;
      margin-bottom: 20px;
      opacity: 0.9;
    }
    
    .hero-title {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 15px;
    }
    
    .hero-subtitle {
      font-size: 1rem;
      opacity: 0.9;
      line-height: 1.6;
    }
    
    .hero-features {
      margin-top: 30px;
    }
    
    .feature-item {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 15px;
      font-size: 0.9rem;
    }
    
    .feature-icon {
      width: 24px;
      height: 24px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
    }
    
    .auth-card {
      flex: 1;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    
    .auth-header {
      text-align: center;
      margin-bottom: 40px;
    }
    
    .auth-title {
      font-weight: 700;
      color: var(--dark-color);
      margin-bottom: 10px;
      font-size: 2rem;
    }
    
    .auth-subtitle {
      color: #666;
      font-size: 1rem;
    }
    
    /* Form Styles */
    .form-group {
      margin-bottom: 25px;
      position: relative;
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
      padding: 14px 16px;
      border: 2px solid #e0e0e0;
      border-radius: 12px;
      font-size: 0.9rem;
      transition: all 0.3s;
      background: #fafafa;
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
      background: white;
    }
    
    .form-control.with-icon {
      padding-left: 50px;
    }
    
    .input-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 1.1rem;
    }
    
    /* Form Options */
    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      font-size: 0.85rem;
    }
    
    /* Submit Button */
    .submit-btn {
      width: 100%;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border: none;
      padding: 16px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s;
      margin-bottom: 25px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    
    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(33, 150, 243, 0.3);
    }
    
    .submit-btn:active {
      transform: translateY(0);
    }
    
    /* Back to Login Button */
    .back-btn {
      width: 100%;
      background: #f8f9fa;
      color: #666;
      border: 2px solid #e0e0e0;
      padding: 16px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s;
      margin-bottom: 25px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      text-decoration: none;
    }
    
    .back-btn:hover {
      background: #e9ecef;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      color: #333;
    }
    
    /* Error Messages */
    .error-message {
      color: #dc3545;
      font-size: 0.85rem;
      margin-top: 5px;
      display: block;
    }
    
    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 0.9rem;
    }
    
    .alert-success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    
    .alert-error {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    
    .alert-info {
      background: #d1ecf1;
      color: #0c5460;
      border: 1px solid #bee5eb;
    }
    
    /* Info Message */
    .info-message {
      background: #f0f9ff;
      border: 1px solid #bae6fd;
      color: #0369a1;
      padding: 16px;
      border-radius: 12px;
      margin-bottom: 25px;
      font-size: 0.9rem;
      line-height: 1.6;
    }
    
    /* Sign Up Link */
    .signup-link {
      text-align: center;
      color: #666;
      font-size: 0.9rem;
    }
    
    .signup-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s;
    }
    
    .signup-link a:hover {
      color: var(--secondary-color);
      text-decoration: underline;
    }
    
    /* Footer */
    .footer {
      background: var(--dark-color);
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 0.85rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .auth-wrapper {
        flex-direction: column;
        margin: 20px;
      }
      
      .auth-hero {
        padding: 30px;
        text-align: center;
      }
      
      .auth-card {
        padding: 30px;
      }
      
      .hero-title {
        font-size: 1.8rem;
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
        
        <div class="nav-right">
          <a href="{{ url('/register') }}" class="register-btn">Sign Up Free</a>
        </div>
      </div>
    </div>
  </header>

  <!-- AUTH SECTION -->
  <div class="auth-container">
    <div class="auth-wrapper">
      <!-- Hero Section -->
      <div class="auth-hero">
        <div class="auth-hero-content">
          <div class="hero-icon">
            <i class="bi bi-key"></i>
          </div>
          <h1 class="hero-title">Reset Your Password</h1>
          <p class="hero-subtitle">Forgot your password? No worries! Enter your email address and we'll send you a link to reset your password and get back to your learning journey.</p>
          
          <div class="hero-features">
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-shield-check"></i>
              </div>
              <span>Secure password reset</span>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-envelope-check"></i>
              </div>
              <span>Email verification link</span>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-clock-history"></i>
              </div>
              <span>Link expires in 24 hours</span>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-lock-fill"></i>
              </div>
              <span>100% secure process</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Forgot Password Form -->
      <div class="auth-card">
        <div class="auth-header">
          <h1 class="auth-title">Forgot Password</h1>
          <p class="auth-subtitle">Enter your email to reset your password</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
          <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i> {{ session('status') }}
          </div>
        @endif

        <!-- Info Message -->
        <div class="info-message">
          <i class="bi bi-info-circle me-2"></i> 
          Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
          <div class="alert alert-error">
            <i class="bi bi-exclamation-triangle me-2"></i>
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <div class="form-group">
            <label class="form-label">Email Address</label>
            <div class="position-relative">
              <i class="bi bi-envelope input-icon"></i>
              <input type="email" 
                     class="form-control with-icon" 
                     id="email" 
                     name="email" 
                     value="{{ old('email') }}" 
                     placeholder="Enter your registered email" 
                     required 
                     autofocus>
            </div>
            @error('email')
              <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="submit-btn">
            <i class="bi bi-send"></i> Send Reset Link
          </button>

          <a href="{{ route('login') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i> Back to Login
          </a>

          <div class="signup-link">
            Don't have an account? <a href="{{ route('register') }}">Create one here</a>
          </div>
        </form>
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
    // Form loading state
    document.querySelector('form').addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('.submit-btn');
      const originalText = submitBtn.innerHTML;
      
      // Loading state
      submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Sending Reset Link...';
      submitBtn.disabled = true;
      
      // Re-enable after 3 seconds if still on page (fallback)
      setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
      }, 3000);
    });

    // Add spinner animation
    const style = document.createElement('style');
    style.textContent = `
      .spinner {
        animation: spin 1s linear infinite;
      }
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    `;
    document.head.appendChild(style);
  </script>

</body>
</html>