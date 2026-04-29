<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage {{ $course->title }} | Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2196f3;
            --secondary-color: #6ec6ff;
            --dark-color: #2c3e50;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        
        /* Header */
        .course-management-header {
            background: white;
            padding: 25px 0;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .course-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
        }
        
        .course-meta {
            display: flex;
            gap: 20px;
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 10px;
        }
        
        /* Management Tabs */
        .management-tabs {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .nav-tabs-custom {
            border-bottom: 2px solid #e9ecef;
        }
        
        .nav-tabs-custom .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 20px;
            margin-right: 10px;
            border-radius: 8px 8px 0 0;
            background: transparent;
        }
        
        .nav-tabs-custom .nav-link.active {
            color: var(--primary-color);
            background: #e3f2fd;
            border-bottom: 3px solid var(--primary-color);
        }
        
        /* Content Sections */
        .management-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
        }
        
        /* Module Cards */
        .module-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .module-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(33, 150, 243, 0.1);
        }
        
        .module-header {
            background: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .module-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }
        
        .lesson-list {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        
        .lesson-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background 0.3s ease;
        }
        
        .lesson-item:hover {
            background: #f8f9fa;
        }
        
        .lesson-item:last-child {
            border-bottom: none;
        }
        
        .lesson-info {
            flex: 1;
        }
        
        .lesson-title {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .lesson-meta {
            display: flex;
            gap: 15px;
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .lesson-type-badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-video { background: #e3f2fd; color: #1976d2; }
        .badge-reading { background: #e8f5e9; color: #388e3c; }
        .badge-quiz { background: #fff3e0; color: #f57c00; }
        .badge-assignment { background: #fce4ec; color: #c2185b; }
        
        /* Forms */
        .form-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
        }
        
        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            border: 1px solid #e9ecef;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.95rem;
        }
        
        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .action-btn {
            padding: 15px;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            color: var(--dark-color);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        
        .action-btn:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .action-btn i {
            font-size: 1.5rem;
        }
        
        /* Tables */
        .progress-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .progress-table th,
        .progress-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
            text-align: left;
        }
        
        .progress-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .progress-table tr:hover {
            background: #f8f9fa;
        }
        
        /* Buttons */
        .btn-custom {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-primary-custom:hover {
            background: #1976d2;
            transform: translateY(-2px);
        }
        
        .btn-success-custom {
            background: var(--success-color);
            color: white;
        }
        
        .btn-danger-custom {
            background: var(--danger-color);
            color: white;
        }
        
        /* Modal */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .modal-header {
            border-bottom: 2px solid #e9ecef;
            padding: 20px 25px;
        }
        
        .modal-body {
            padding: 25px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .course-title {
                font-size: 1.5rem;
            }
            
            .course-meta {
                flex-direction: column;
                gap: 5px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        /* Drag and Drop */
        .drag-handle {
            cursor: move;
            color: #6c757d;
            padding: 5px;
        }
        
        .drag-handle:hover {
            color: var(--primary-color);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #adb5bd;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="course-management-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="course-title">{{ $course->title }}</h1>
                    <div class="course-meta">
                        <span><i class="bi bi-person"></i> {{ $course->instructor }}</span>
                        <span><i class="bi bi-people"></i> {{ $course->enrolled_count }} students</span>
                        <span><i class="bi bi-book"></i> {{ $totalLessons }} lessons</span>
                        <span><i class="bi bi-tasks"></i> {{ $totalAssignments }} assignments</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Management Tabs -->
        <div class="management-tabs">
            <ul class="nav nav-tabs-custom" id="managementTabs">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-target="#content" data-bs-toggle="tab">
                        <i class="bi bi-collection"></i> Course Content
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-target="#assignments" data-bs-toggle="tab">
                        <i class="bi bi-clipboard-check"></i> Assignments
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-target="#progress" data-bs-toggle="tab">
                        <i class="bi bi-bar-chart"></i> Student Progress
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-target="#settings" data-bs-toggle="tab">
                        <i class="bi bi-gear"></i> Course Settings
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="managementTabContent">
            <!-- Content Tab -->
            <div class="tab-pane fade show active" id="content">
                <!-- Quick Actions -->
                <div class="quick-actions">
                    <button class="action-btn" data-bs-toggle="modal" data-bs-target="#addModuleModal">
                        <i class="bi bi-folder-plus"></i>
                        <span>Add Module</span>
                    </button>
                    <button class="action-btn" data-bs-toggle="modal" data-bs-target="#addLessonModal">
                        <i class="bi bi-file-earmark-plus"></i>
                        <span>Add Lesson</span>
                    </button>
                    <button class="action-btn" data-bs-toggle="modal" data-bs-target="#addAssignmentModal">
                        <i class="bi bi-clipboard-plus"></i>
                        <span>Add Assignment</span>
                    </button>
                    <a href="#" class="action-btn">
                        <i class="bi bi-eye"></i>
                        <span>Preview Course</span>
                    </a>
                    <a href="#" class="action-btn">
                        <i class="bi bi-download"></i>
                        <span>Export Content</span>
                    </a>
                </div>

                <!-- Modules Section -->
                <div class="management-section">
                    <h3 class="section-title">Course Modules & Lessons</h3>
                    
                    @if($modules->count() > 0)
                        @foreach($modules as $module)
                        <div class="module-card">
                            <div class="module-header" data-bs-toggle="collapse" data-bs-target="#module-{{ $module->id }}">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="drag-handle">
                                        <i class="bi bi-grip-vertical"></i>
                                    </span>
                                    <h4 class="module-title">{{ $module->title }}</h4>
                                    <span class="badge bg-light text-dark">
                                        {{ $module->lessons->count() }} lessons
                                    </span>
                                </div>
                                <div class="module-actions">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModuleModal"
                                            data-module-id="{{ $module->id }}"
                                            data-module-title="{{ $module->title }}"
                                            data-module-description="{{ $module->description }}"
                                            data-module-order="{{ $module->order }}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModuleModal"
                                            data-module-id="{{ $module->id }}"
                                            data-module-title="{{ $module->title }}">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                            <div class="collapse show" id="module-{{ $module->id }}">
                                <ul class="lesson-list">
                                    @if($module->lessons->count() > 0)
                                        @foreach($module->lessons as $lesson)
                                        <li class="lesson-item">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="drag-handle">
                                                    <i class="bi bi-grip-vertical"></i>
                                                </span>
                                                <div class="lesson-info">
                                                    <div class="lesson-title">{{ $lesson->title }}</div>
                                                    <div class="lesson-meta">
                                                        <span><i class="bi bi-clock"></i> {{ $lesson->duration }} min</span>
                                                        <span class="lesson-type-badge badge-{{ $lesson->type }}">
                                                            {{ ucfirst($lesson->type) }}
                                                        </span>
                                                        @if($lesson->attachment_name)
                                                            <span><i class="bi bi-paperclip"></i> Attachment</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="lesson-actions">
                                                <button class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editLessonModal"
                                                        data-lesson-id="{{ $lesson->id }}"
                                                        data-lesson-title="{{ $lesson->title }}"
                                                        data-lesson-content="{{ $lesson->content }}"
                                                        data-lesson-type="{{ $lesson->type }}"
                                                        data-lesson-duration="{{ $lesson->duration }}"
                                                        data-lesson-order="{{ $lesson->order }}"
                                                        data-lesson-video-url="{{ $lesson->video_url }}"
                                                        data-module-id="{{ $module->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteLessonModal"
                                                        data-lesson-id="{{ $lesson->id }}"
                                                        data-lesson-title="{{ $lesson->title }}"
                                                        data-module-id="{{ $module->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </li>
                                        @endforeach
                                    @else
                                        <li class="lesson-item">
                                            <div class="empty-state py-4">
                                                <i class="bi bi-journal"></i>
                                                <p>No lessons in this module yet.</p>
                                                <button class="btn btn-sm btn-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#addLessonModal"
                                                        data-module-id="{{ $module->id }}">
                                                    Add First Lesson
                                                </button>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="bi bi-journals"></i>
                            <h4>No Modules Yet</h4>
                            <p>Start by creating your first module to organize course content.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModuleModal">
                                <i class="bi bi-plus-circle"></i> Create First Module
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Assignments Tab -->
            <div class="tab-pane fade" id="assignments">
                <div class="management-section">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="section-title mb-0">Assignments</h3>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAssignmentModal">
                            <i class="bi bi-plus-circle"></i> New Assignment
                        </button>
                    </div>
                    
                    @if($course->assignments->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Due Date</th>
                                        <th>Total Marks</th>
                                        <th>Submissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course->assignments as $assignment)
                                    <tr>
                                        <td>
                                            <strong>{{ $assignment->title }}</strong>
                                            @if($assignment->attachment_name)
                                                <br><small class="text-muted"><i class="bi bi-paperclip"></i> {{ $assignment->attachment_name }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">{{ ucfirst($assignment->type) }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}</td>
                                        <td>{{ $assignment->total_marks }}</td>
                                        <td>
                                            <span class="badge bg-info">0 submitted</span>
                                            <!-- Replace with actual count: {{ $assignment->submissions->count() }} -->
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('teacher.submissions.view', ['course' => $course->id, 'assignment' => $assignment->id]) }}" 
                                                   class="btn btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <button class="btn btn-outline-secondary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editAssignmentModal"
                                                        data-assignment-id="{{ $assignment->id }}"
                                                        data-assignment-title="{{ $assignment->title }}"
                                                        data-assignment-description="{{ $assignment->description }}"
                                                        data-assignment-due-date="{{ $assignment->due_date }}"
                                                        data-assignment-total-marks="{{ $assignment->total_marks }}"
                                                        data-assignment-type="{{ $assignment->type }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteAssignmentModal"
                                                        data-assignment-id="{{ $assignment->id }}"
                                                        data-assignment-title="{{ $assignment->title }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-clipboard"></i>
                            <h4>No Assignments Yet</h4>
                            <p>Create assignments to assess student learning.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAssignmentModal">
                                <i class="bi bi-plus-circle"></i> Create First Assignment
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Progress Tab -->
            <div class="tab-pane fade" id="progress">
                <div class="management-section">
                    <h3 class="section-title">Student Progress</h3>
                    
                    <div class="stats-grid mb-4">
                        <div class="stat-card">
                            <div class="stat-number">{{ $course->enrolled_count }}</div>
                            <div class="stat-label">Total Students</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">0%</div>
                            <div class="stat-label">Average Progress</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Completed Students</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Active This Week</div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table progress-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Enrollment Date</th>
                                    <th>Progress</th>
                                    <th>Last Activity</th>
                                    <th>Completed Lessons</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- This would be populated from $enrollments -->
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="bi bi-people text-muted" style="font-size: 2rem;"></i>
                                        <p class="mt-2">No student data available yet.</p>
                                        <small class="text-muted">Student progress will appear here once they start the course.</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div class="tab-pane fade" id="settings">
                <div class="management-section">
                    <h3 class="section-title">Course Settings</h3>
                    
                    <form action="{{ route('teacher.courses.settings', $course->id) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-card">
                                    <h5 class="mb-4">Basic Information</h5>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Course Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="6" required>{{ $course->description }}</textarea>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Category</label>
                                            <input type="text" name="category" class="form-control" value="{{ $course->category }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Skill Level</label>
                                            <select name="skill_level" class="form-select" required>
                                                <option value="Beginner" {{ $course->skill_level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                                <option value="Intermediate" {{ $course->skill_level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                <option value="Advanced" {{ $course->skill_level == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-card">
                                    <h5 class="mb-4">Enrollment Settings</h5>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Enrollment Key</label>
                                        <input type="text" name="enrollment_key" class="form-control" value="{{ $course->enrollment_key }}" 
                                               placeholder="Leave empty for open enrollment">
                                        <small class="text-muted">Students will need this key to enroll in the course</small>
                                    </div>
                                    
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_published" id="isPublished" 
                                               {{ $course->is_published ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isPublished">
                                            Publish Course
                                        </label>
                                        <small class="text-muted d-block">Unpublished courses are only visible to you</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-card">
                                    <h5 class="mb-4">Course Image</h5>
                                    
                                    <div class="text-center mb-3">
                                        @if($course->image)
                                            <img src="{{ Storage::url($course->image) }}" alt="Course Image" 
                                                 class="img-fluid rounded" style="max-height: 200px;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="height: 150px;">
                                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <form action="{{ route('teacher.courses.upload-image', $course->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Upload New Image</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-upload"></i> Upload Image
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="form-card">
                                    <h5 class="mb-4">Danger Zone</h5>
                                    
                                    <div class="alert alert-danger">
                                        <h6><i class="bi bi-exclamation-triangle"></i> Warning</h6>
                                        <p class="small mb-2">These actions cannot be undone.</p>
                                    </div>
                                    
                                    <button type="button" class="btn btn-outline-danger w-100 mb-2" data-bs-toggle="modal" data-bs-target="#resetCourseModal">
                                        <i class="bi bi-arrow-clockwise"></i> Reset Course Progress
                                    </button>
                                    
                                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">
                                        <i class="bi bi-trash"></i> Delete Course
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end mt-4">
                            <a href="{{ route('teacher.courses.manage', $course->id) }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('teacher.modals.module')
    @include('teacher.modals.lesson')
    @include('teacher.modals.assignment')
    @include('teacher.modals.delete')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize all tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Module modals
        const editModuleModal = document.getElementById('editModuleModal');
        if (editModuleModal) {
            editModuleModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const moduleId = button.getAttribute('data-module-id');
                const moduleTitle = button.getAttribute('data-module-title');
                const moduleDescription = button.getAttribute('data-module-description');
                const moduleOrder = button.getAttribute('data-module-order');
                
                const modal = this;
                modal.querySelector('input[name="module_id"]').value = moduleId;
                modal.querySelector('input[name="title"]').value = moduleTitle;
                modal.querySelector('textarea[name="description"]').value = moduleDescription;
                modal.querySelector('input[name="order"]').value = moduleOrder;
                
                // Update form action
                const form = modal.querySelector('form');
                form.action = `/teacher/courses/{{ $course->id }}/modules/${moduleId}`;
                form.querySelector('input[name="_method"]').value = 'PUT';
            });
        }

        // Lesson modals
        const editLessonModal = document.getElementById('editLessonModal');
        if (editLessonModal) {
            editLessonModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const lessonId = button.getAttribute('data-lesson-id');
                const lessonTitle = button.getAttribute('data-lesson-title');
                const lessonContent = button.getAttribute('data-lesson-content');
                const lessonType = button.getAttribute('data-lesson-type');
                const lessonDuration = button.getAttribute('data-lesson-duration');
                const lessonOrder = button.getAttribute('data-lesson-order');
                const lessonVideoUrl = button.getAttribute('data-lesson-video-url');
                const moduleId = button.getAttribute('data-module-id');
                
                const modal = this;
                modal.querySelector('input[name="lesson_id"]').value = lessonId;
                modal.querySelector('input[name="title"]').value = lessonTitle;
                modal.querySelector('textarea[name="content"]').value = lessonContent;
                modal.querySelector('select[name="type"]').value = lessonType;
                modal.querySelector('input[name="duration"]').value = lessonDuration;
                modal.querySelector('input[name="order"]').value = lessonOrder;
                modal.querySelector('input[name="video_url"]').value = lessonVideoUrl || '';
                modal.querySelector('select[name="module_id"]').value = moduleId;
                
                // Show/hide video URL field based on type
                toggleVideoUrlField(lessonType);
                
                // Update form action
                const form = modal.querySelector('form');
                form.action = `/teacher/courses/{{ $course->id }}/modules/${moduleId}/lessons/${lessonId}`;
                form.querySelector('input[name="_method"]').value = 'PUT';
            });
        }

        // Assignment modals
        const editAssignmentModal = document.getElementById('editAssignmentModal');
        if (editAssignmentModal) {
            editAssignmentModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const assignmentId = button.getAttribute('data-assignment-id');
                const assignmentTitle = button.getAttribute('data-assignment-title');
                const assignmentDescription = button.getAttribute('data-assignment-description');
                const assignmentDueDate = button.getAttribute('data-assignment-due-date');
                const assignmentTotalMarks = button.getAttribute('data-assignment-total-marks');
                const assignmentType = button.getAttribute('data-assignment-type');
                
                const modal = this;
                modal.querySelector('input[name="assignment_id"]').value = assignmentId;
                modal.querySelector('input[name="title"]').value = assignmentTitle;
                modal.querySelector('textarea[name="description"]').value = assignmentDescription;
                modal.querySelector('input[name="due_date"]').value = assignmentDueDate;
                modal.querySelector('input[name="total_marks"]').value = assignmentTotalMarks;
                modal.querySelector('select[name="type"]').value = assignmentType;
                
                // Update form action
                const form = modal.querySelector('form');
                form.action = `/teacher/courses/{{ $course->id }}/assignments/${assignmentId}`;
                form.querySelector('input[name="_method"]').value = 'PUT';
            });
        }

        // Delete modals
        const deleteModuleModal = document.getElementById('deleteModuleModal');
        if (deleteModuleModal) {
            deleteModuleModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const moduleId = button.getAttribute('data-module-id');
                const moduleTitle = button.getAttribute('data-module-title');
                
                const modal = this;
                modal.querySelector('#deleteModuleTitle').textContent = moduleTitle;
                
                const form = modal.querySelector('form');
                form.action = `/teacher/courses/{{ $course->id }}/modules/${moduleId}`;
            });
        }

        // Toggle video URL field based on lesson type
        function toggleVideoUrlField(type) {
            const videoUrlField = document.getElementById('videoUrlField');
            if (videoUrlField) {
                if (type === 'video') {
                    videoUrlField.style.display = 'block';
                } else {
                    videoUrlField.style.display = 'none';
                }
            }
        }

        // Listen for type change in lesson forms
        document.querySelectorAll('select[name="type"]').forEach(select => {
            select.addEventListener('change', function() {
                toggleVideoUrlField(this.value);
            });
        });

        // Initialize sortable for modules and lessons (requires additional library)
        // You can add Sortable.js or similar for drag and drop functionality

        // Tab persistence
        const tabEl = document.querySelector('button[data-bs-toggle="tab"]');
        if (tabEl) {
            tabEl.addEventListener('shown.bs.tab', function(event) {
                localStorage.setItem('activeTab', event.target.getAttribute('data-bs-target'));
            });
        }

        const activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            const triggerEl = document.querySelector(`[data-bs-target="${activeTab}"]`);
            if (triggerEl) {
                bootstrap.Tab.getOrCreateInstance(triggerEl).show();
            }
        }

        // Auto-expand textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    </script>
</body>
</html>