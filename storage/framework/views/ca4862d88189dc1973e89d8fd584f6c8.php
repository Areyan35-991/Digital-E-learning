<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BLC E-Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64 bg-blue-800 text-white min-h-screen">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <p class="text-blue-200 text-sm">BLC E-Learning</p>
            </div>
            <nav class="mt-6">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block py-2 px-4 hover:bg-blue-700 <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-700' : ''); ?>">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
                <a href="<?php echo e(route('admin.users')); ?>" class="block py-2 px-4 hover:bg-blue-700 <?php echo e(request()->routeIs('admin.users') ? 'bg-blue-700' : ''); ?>">
                    <i class="fas fa-users mr-2"></i>Users
                </a>
                <a href="<?php echo e(route('admin.courses')); ?>" class="block py-2 px-4 hover:bg-blue-700 <?php echo e(request()->routeIs('admin.courses') ? 'bg-blue-700' : ''); ?>">
                    <i class="fas fa-book mr-2"></i>Courses
                </a>
                <a href="/dashboard" class="block py-2 px-4 hover:bg-blue-700">
                    <i class="fas fa-home mr-2"></i>Back to Site
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full text-left py-2 px-4 hover:bg-blue-700">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <div class="p-6">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\User\blc-elearning\resources\views/layouts/admin.blade.php ENDPATH**/ ?>