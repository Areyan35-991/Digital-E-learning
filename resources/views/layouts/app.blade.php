<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Digital E-Learning')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="container">
            <div class="nav-container">
                <div class="nav-left">
                    <div class="logo-section">
                        <img src="{{ asset('images/logo.png') }}" class="logo-image">
                        <div class="logo-text">Digital E-Learning</div>
                    </div>
                    
                    <nav>
                        <ul class="nav-links">
                            <!-- Common navigation for all users -->
                            <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                            <li><a href="{{ url('/courses') }}" class="{{ request()->is('courses') ? 'active' : '' }}">Courses</a></li>
                            
                            <!-- Dynamic navigation based on auth -->
                            @auth
                                @if(auth()->user()->role === 'student')
                                    <li><a href="{{ route('student.dashboard') }}" class="{{ request()->is('student/dashboard') ? 'active' : '' }}">Dashboard</a></li>
                                    <li><a href="{{ route('student.my-courses') }}" class="{{ request()->is('student/my-courses') ? 'active' : '' }}">My Courses</a></li>
                                @elseif(auth()->user()->role === 'teacher')
                                    <li><a href="{{ route('teacher.dashboard') }}" class="{{ request()->is('teacher/dashboard') ? 'active' : '' }}">Dashboard</a></li>
                                @elseif(auth()->user()->role === 'admin')
                                    <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">Admin Panel</a></li>
                                @endif
                            @else
                                <li><a href="{{ url('/guidelines') }}">Guidelines</a></li>
                            @endauth
                        </ul>
                    </nav>
                </div>
                
                <div class="nav-right">
                    @auth
                        <!-- Logged in user menu -->
                        <span class="me-3">Welcome, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm">Logout</button>
                        </form>
                    @else
                        <!-- Guest user menu -->
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm ms-2">Sign Up Free</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© 2025 Digital E-Learning | All Rights Reserved</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>