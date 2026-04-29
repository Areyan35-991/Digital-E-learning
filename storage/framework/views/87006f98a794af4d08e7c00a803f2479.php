

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
    <p class="text-gray-600">Welcome to your administration panel</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-500 rounded-lg">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-800"><?php echo e($stats['total_users']); ?></h3>
                <p class="text-gray-600">Total Users</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-500 rounded-lg">
                <i class="fas fa-book text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-800"><?php echo e($stats['total_courses']); ?></h3>
                <p class="text-gray-600">Academic Courses</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-500 rounded-lg">
                <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-800"><?php echo e($stats['total_teachers']); ?></h3>
                <p class="text-gray-600">Faculty Members</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-orange-500 rounded-lg">
                <i class="fas fa-user-graduate text-white text-xl"></i>
            </div>
             <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-800"><?php echo e($stats['total_students']); ?></h3>
                <p class="text-gray-600">Students</p>
            </div>
            
        </div>
    </div>
</div>

<!-- Recent Activity & Semester Info -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">Current Semester</h2>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                <div>
                    <h3 class="text-lg font-semibold text-blue-800"><?php echo e($stats['active_semester']); ?></h3>
                    <p class="text-blue-600">Active Academic Semester</p>
                </div>
                <div class="text-3xl text-blue-500">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">Quick Actions</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">
                <a href="<?php echo e(route('admin.teachers')); ?>" class="p-4 bg-blue-100 rounded-lg text-center hover:bg-blue-200 transition">
                    <i class="fas fa-chalkboard-teacher text-blue-600 text-xl mb-2"></i>
                    <p class="text-sm font-medium text-blue-800">Manage Faculty</p>
                </a>
                <a href="<?php echo e(route('admin.courses')); ?>" class="p-4 bg-green-100 rounded-lg text-center hover:bg-green-200 transition">
                    <i class="fas fa-book text-green-600 text-xl mb-2"></i>
                    <p class="text-sm font-medium text-green-800">Manage Courses</p>
                </a>
                <a href="<?php echo e(route('admin.users')); ?>" class="p-4 bg-purple-100 rounded-lg text-center hover:bg-purple-200 transition">
                    <i class="fas fa-users text-purple-600 text-xl mb-2"></i>
                    <p class="text-sm font-medium text-purple-800">View Users</p>
                </a>
                <a href="<?php echo e(route('admin.teachers.create')); ?>" class="p-4 bg-orange-100 rounded-lg text-center hover:bg-orange-200 transition">
                    <i class="fas fa-plus text-orange-600 text-xl mb-2"></i>
                    <p class="text-sm font-medium text-orange-800">Add Teacher</p>
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\blc-elearning\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>