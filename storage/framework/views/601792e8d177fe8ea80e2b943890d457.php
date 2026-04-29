<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | Digital E-Learning</title>
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

    /* Header styles */
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
      transform: translateY(-2px);
    }

    /* Auth Container */
    .auth-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 80px 20px 60px;
    }
    
    .auth-wrapper {
      display: flex;
      max-width: 1100px;
      width: 100%;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      min-height: 650px;
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
    
    .role-selector {
      display: flex;
      gap: 15px;
      margin-bottom: 25px;
    }
    
    .role-option {
      flex: 1;
      text-align: center;
      padding: 20px;
      border: 2px solid #e0e0e0;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s;
      background: #fafafa;
    }
    
    .role-option:hover {
      border-color: var(--primary-color);
      transform: translateY(-2px);
    }
    
    .role-option.selected {
      border-color: var(--primary-color);
      background: rgba(33, 150, 243, 0.1);
    }
    
    .role-icon {
      font-size: 2rem;
      margin-bottom: 10px;
      color: var(--primary-color);
    }
    
    .role-name {
      font-weight: 600;
      color: var(--dark-color);
      margin-bottom: 5px;
    }
    
    .role-description {
      font-size: 0.8rem;
      color: #666;
    }
    
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
    
    .login-link {
      text-align: center;
      color: #666;
      font-size: 0.9rem;
    }
    
    .login-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
    }
    
    .login-link a:hover {
      text-decoration: underline;
    }
    
    .footer {
      background: var(--dark-color);
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 0.85rem;
    }

    /* Error messages */
    .error-message {
      color: #dc3545;
      font-size: 0.8rem;
      margin-top: 5px;
    }
    
    .is-invalid {
      border-color: #dc3545 !important;
    }

    /* Educational notice */
    .educational-notice {
      background: rgba(33, 150, 243, 0.1);
      border: 1px solid var(--primary-color);
      border-radius: 8px;
      padding: 12px 15px;
      margin-bottom: 20px;
      font-size: 0.85rem;
    }

    .educational-notice strong {
      color: var(--primary-color);
    }

    /* Loading spinner */
    .spinner {
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

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
      
      .role-selector {
        flex-direction: column;
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
              <li><a href="<?php echo e(url('/courses')); ?>">Courses</a></li>
              <li><a href="<?php echo e(url('/guidelines')); ?>">Guidelines</a></li>
            </ul>
          </nav>
        </div>
        
        <div class="nav-right">
          <a href="<?php echo e(url('/login')); ?>" class="login-btn">Sign In</a>
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
            <i class="bi bi-people-fill"></i>
          </div>
          <h1 class="hero-title">Join Our Learning Community</h1>
          <p class="hero-subtitle">Start your educational journey with access to expert-led courses, interactive learning, and achievement tracking.</p>
          
          <div class="hero-features">
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-check-lg"></i>
              </div>
              <span>Access 500+ courses across various fields</span>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-check-lg"></i>
              </div>
              <span>Track progress with XP and level system</span>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-check-lg"></i>
              </div>
              <span>Earn badges and certificates</span>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-check-lg"></i>
              </div>
              <span>Connect with instructors and peers</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Registration Form -->
      <div class="auth-card">
        <div class="auth-header">
          <h1 class="auth-title">Create Account</h1>
          <p class="auth-subtitle">Join thousands of learners worldwide</p>
        </div>

        <!-- Educational Email Notice -->
        <div class="educational-notice">
          <strong>Note:</strong> Please use your educational institution email address 
          (ending with .edu or your university domain) for registration.
        </div>

        <form action="<?php echo e(route('register')); ?>" method="POST" id="registrationForm">
          <?php echo csrf_field(); ?>
          
          <!-- Name -->
          <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter your full name" required value="<?php echo e(old('name')); ?>">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Email -->
          <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter your educational email" required value="<?php echo e(old('email')); ?>">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Phone -->
          <div class="form-group">
            <label class="form-label">Phone Number (Optional)</label>
            <input type="tel" name="phone" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter your phone number" value="<?php echo e(old('phone')); ?>">
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Role Selection -->
          <div class="role-selector">
            <div class="role-option" data-role="student">
              <div class="role-icon">
                <i class="bi bi-mortarboard"></i>
              </div>
              <div class="role-name">Student</div>
              <div class="role-description">Learn from courses and track progress</div>
            </div>
            <div class="role-option" data-role="teacher">
              <div class="role-icon">
                <i class="bi bi-person-badge"></i>
              </div>
              <div class="role-name">Teacher</div>
              <div class="role-description">Create and manage courses</div>
            </div>
          </div>
          <input type="hidden" name="role" id="selectedRole" value="<?php echo e(old('role', 'student')); ?>" required>
          <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error-message"><?php echo e($message); ?></div>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

          <!-- Password -->
          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Create a password" required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Confirm Password -->
          <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
          </div>

          <button type="submit" class="submit-btn">
            <i class="bi bi-person-plus"></i> Create Account
          </button>

          <div class="login-link">
            Already have an account? <a href="<?php echo e(url('/login')); ?>">Sign in here</a>
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
    
    // Form submission
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('.submit-btn');
      const originalText = submitBtn.innerHTML;
      
      // Loading state
      submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Creating Account...';
      submitBtn.disabled = true;
      
      // Re-enable after 5 seconds in case of error (safety net)
      setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
      }, 5000);
    });

    // Email validation for educational domains (client-side)
    document.querySelector('input[name="email"]').addEventListener('blur', function() {
      const email = this.value.toLowerCase();
      const educationalDomains = ['.edu', '.ac.', '.sch.'];
      const isEducational = educationalDomains.some(domain => email.includes(domain));
      
      if (email && !isEducational) {
        this.style.borderColor = '#ffc107';
      } else {
        this.style.borderColor = '#e0e0e0';
      }
    });
    // Real-time email validation
document.getElementById('email').addEventListener('blur', function() {
    const email = this.value;
    const diuDomain = 'diu.edu.bd';
    
    if (email && !email.endsWith('@' + diuDomain)) {
        // Show error message
        const errorDiv = document.getElementById('email-error') || createErrorElement();
        errorDiv.textContent = 'Only @diu.edu.bd email addresses are allowed.';
        errorDiv.style.display = 'block';
        
        // Disable submit button
        document.querySelector('button[type="submit"]').disabled = true;
    } else {
        // Hide error message
        const errorDiv = document.getElementById('email-error');
        if (errorDiv) errorDiv.style.display = 'none';
        
        // Enable submit button
        document.querySelector('button[type="submit"]').disabled = false;
    }
});

function createErrorElement() {
    const errorDiv = document.createElement('div');
    errorDiv.id = 'email-error';
    errorDiv.style.color = 'red';
    errorDiv.style.fontSize = '0.875rem';
    errorDiv.style.marginTop = '0.25rem';
    document.getElementById('email').parentNode.appendChild(errorDiv);
    return errorDiv;
}
  </script>

</body>
</html><?php /**PATH C:\Users\User\blc-elearning\resources\views/auth/register.blade.php ENDPATH**/ ?>