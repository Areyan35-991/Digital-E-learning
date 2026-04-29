<!-- Delete Module Modal -->
<div class="modal fade" id="deleteModuleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle"></i> Delete Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-octagon"></i>
                        <strong>Warning:</strong> This action cannot be undone.
                    </div>
                    <p>Are you sure you want to delete the module <strong id="deleteModuleTitle"></strong>?</p>
                    <p class="text-danger">This will also delete all lessons within this module.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Module</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Lesson Modal -->
<div class="modal fade" id="deleteLessonModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="module_id" id="deleteLessonModuleId">
                <div class="modal-header">
                    <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle"></i> Delete Lesson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-octagon"></i>
                        <strong>Warning:</strong> This action cannot be undone.
                    </div>
                    <p>Are you sure you want to delete the lesson <strong id="deleteLessonTitle"></strong>?</p>
                    <p>Any associated files will also be deleted.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Lesson</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Assignment Modal -->
<div class="modal fade" id="deleteAssignmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle"></i> Delete Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-octagon"></i>
                        <strong>Warning:</strong> This action cannot be undone.
                    </div>
                    <p>Are you sure you want to delete the assignment <strong id="deleteAssignmentTitle"></strong>?</p>
                    <p class="text-danger">This will also delete all student submissions for this assignment.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Assignment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reset Course Modal -->
<div class="modal fade" id="resetCourseModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-warning"><i class="bi bi-exclamation-triangle"></i> Reset Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-octagon"></i>
                    <strong>Extreme Warning:</strong> This will affect all students enrolled in this course.
                </div>
                <p>Resetting the course will:</p>
                <ul>
                    <li>Clear all student progress and completion data</li>
                    <li>Reset all enrollment statistics to zero</li>
                    <li>Remove all student-submitted assignments</li>
                    <li>Keep course content intact</li>
                </ul>
                <p><strong>This action cannot be undone!</strong></p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="confirmReset">
                    <label class="form-check-label" for="confirmReset">
                        I understand the consequences and want to proceed
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" id="resetCourseBtn" disabled>Reset Course</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Course Modal -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle"></i> Delete Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-octagon"></i>
                    <strong>Danger Zone:</strong> This is a permanent and irreversible action.
                </div>
                <p>Deleting the course <strong>{{ $course->title }}</strong> will:</p>
                <ul>
                    <li>Permanently delete all course content (modules, lessons, assignments)</li>
                    <li>Remove all student enrollments and progress data</li>
                    <li>Delete all submitted assignments and grades</li>
                    <li>Remove the course from the system completely</li>
                </ul>
                <p class="text-danger"><strong>This action is permanent and cannot be recovered!</strong></p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="confirmDelete">
                    <label class="form-check-label" for="confirmDelete">
                        I understand this is permanent and want to proceed
                    </label>
                </div>
                <div class="mt-3">
                    <label class="form-label">Type the course title to confirm:</label>
                    <input type="text" class="form-control" id="confirmCourseTitle" 
                           placeholder="Type: {{ $course->title }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="#" method="POST" id="deleteCourseForm" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-danger" id="deleteCourseBtn" disabled>Delete Course Permanently</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Delete modals setup
    const deleteLessonModal = document.getElementById('deleteLessonModal');
    if (deleteLessonModal) {
        deleteLessonModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const lessonId = button.getAttribute('data-lesson-id');
            const lessonTitle = button.getAttribute('data-lesson-title');
            const moduleId = button.getAttribute('data-module-id');
            
            const modal = this;
            modal.querySelector('#deleteLessonTitle').textContent = lessonTitle;
            modal.querySelector('#deleteLessonModuleId').value = moduleId;
            
            const form = modal.querySelector('form');
            form.action = `/teacher/courses/{{ $course->id }}/modules/${moduleId}/lessons/${lessonId}`;
        });
    }

    const deleteAssignmentModal = document.getElementById('deleteAssignmentModal');
    if (deleteAssignmentModal) {
        deleteAssignmentModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const assignmentId = button.getAttribute('data-assignment-id');
            const assignmentTitle = button.getAttribute('data-assignment-title');
            
            const modal = this;
            modal.querySelector('#deleteAssignmentTitle').textContent = assignmentTitle;
            
            const form = modal.querySelector('form');
            form.action = `/teacher/courses/{{ $course->id }}/assignments/${assignmentId}`;
        });
    }

    // Reset Course Modal
    const confirmResetCheckbox = document.getElementById('confirmReset');
    const resetCourseBtn = document.getElementById('resetCourseBtn');
    
    if (confirmResetCheckbox && resetCourseBtn) {
        confirmResetCheckbox.addEventListener('change', function() {
            resetCourseBtn.disabled = !this.checked;
        });
        
        resetCourseBtn.addEventListener('click', function() {
            if (confirm('Are you absolutely sure? This will reset ALL student progress!')) {
                // Implement reset logic here
                alert('Course reset functionality would be implemented here.');
                // Example: fetch('/teacher/courses/{{ $course->id }}/reset', { method: 'POST' })
            }
        });
    }

    // Delete Course Modal
    const confirmDeleteCheckbox = document.getElementById('confirmDelete');
    const confirmCourseTitleInput = document.getElementById('confirmCourseTitle');
    const deleteCourseBtn = document.getElementById('deleteCourseBtn');
    const deleteCourseForm = document.getElementById('deleteCourseForm');
    
    if (confirmDeleteCheckbox && confirmCourseTitleInput && deleteCourseBtn) {
        function validateDeleteCourse() {
            const isChecked = confirmDeleteCheckbox.checked;
            const isTitleCorrect = confirmCourseTitleInput.value === '{{ $course->title }}';
            deleteCourseBtn.disabled = !(isChecked && isTitleCorrect);
        }
        
        confirmDeleteCheckbox.addEventListener('change', validateDeleteCourse);
        confirmCourseTitleInput.addEventListener('input', validateDeleteCourse);
        
        deleteCourseBtn.addEventListener('click', function() {
            if (confirm('This will PERMANENTLY DELETE the course and all associated data. Are you sure?')) {
                // Set form action and submit
                deleteCourseForm.action = '{{ route("admin.courses.destroy", $course->id) }}'; // You need to create this route
                deleteCourseForm.submit();
            }
        });
    }

    // Add Lesson Modal - Set module from context
    const addLessonBtn = document.getElementById('addLessonBtn');
    const addLessonModal = document.getElementById('addLessonModal');
    
    if (addLessonModal) {
        addLessonModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            if (button && button.hasAttribute('data-module-id')) {
                const moduleId = button.getAttribute('data-module-id');
                this.querySelector('#addLessonModuleId').value = moduleId;
                this.querySelector('select[name="module_id"]').value = moduleId;
            }
        });
    }

    // Edit Lesson Modal - Show current attachment
    const editLessonModal = document.getElementById('editLessonModal');
    if (editLessonModal) {
        editLessonModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const attachmentName = button.getAttribute('data-attachment-name');
            const currentAttachmentInfo = this.querySelector('#currentAttachmentInfo');
            const currentAttachmentName = this.querySelector('#currentAttachmentName');
            
            if (attachmentName && attachmentName !== 'null') {
                currentAttachmentInfo.style.display = 'block';
                currentAttachmentName.textContent = attachmentName;
            } else {
                currentAttachmentInfo.style.display = 'none';
            }
        });
    }

    // Edit Assignment Modal - Show current attachment
    const editAssignmentModal = document.getElementById('editAssignmentModal');
    if (editAssignmentModal) {
        editAssignmentModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const attachmentName = button.getAttribute('data-attachment-name');
            const currentAttachmentInfo = this.querySelector('#currentAssignmentAttachmentInfo');
            const currentAttachmentName = this.querySelector('#currentAssignmentAttachmentName');
            
            if (attachmentName && attachmentName !== 'null') {
                currentAttachmentInfo.style.display = 'block';
                currentAttachmentName.textContent = attachmentName;
            } else {
                currentAttachmentInfo.style.display = 'none';
            }
        });
    }
</script>