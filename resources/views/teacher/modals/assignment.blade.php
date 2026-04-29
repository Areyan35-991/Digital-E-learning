<!-- Add Assignment Modal -->
<div class="modal fade" id="addAssignmentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('teacher.assignments.create', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create New Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Assignment Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select" required>
                                <option value="essay">Essay</option>
                                <option value="quiz">Quiz</option>
                                <option value="project">Project</option>
                                <option value="presentation">Presentation</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description & Instructions</label>
                        <textarea name="description" class="form-control" rows="5" required placeholder="Provide clear instructions for the assignment..."></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date" class="form-control" required 
                                   min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Marks</label>
                            <input type="number" name="total_marks" class="form-control" value="100" min="1" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Attachment (Optional)</label>
                        <input type="file" name="attachment" class="form-control">
                        <small class="text-muted">Supporting documents, templates, or resources (Max: 20MB)</small>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        <strong>Tip:</strong> Students will be able to submit their work through the student portal. You'll be notified when submissions are made.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Assignment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Assignment Modal -->
<div class="modal fade" id="editAssignmentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="assignment_id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Assignment Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select" required>
                                <option value="essay">Essay</option>
                                <option value="quiz">Quiz</option>
                                <option value="project">Project</option>
                                <option value="presentation">Presentation</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description & Instructions</label>
                        <textarea name="description" class="form-control" rows="5" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Marks</label>
                            <input type="number" name="total_marks" class="form-control" min="1" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Attachment</label>
                        <div class="input-group">
                            <input type="file" name="attachment" class="form-control">
                            <div class="input-group-text">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_attachment" id="removeAssignmentAttachment">
                                    <label class="form-check-label" for="removeAssignmentAttachment">
                                        Remove
                                    </label>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">Leave empty to keep current attachment</small>
                    </div>
                    
                    <!-- Current attachment info -->
                    <div class="alert alert-info" id="currentAssignmentAttachmentInfo" style="display: none;">
                        <i class="bi bi-paperclip"></i>
                        <span id="currentAssignmentAttachmentName"></span>
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>Note:</strong> Changing the due date after students have submitted work may affect their submission status.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Assignment</button>
                </div>
            </form>
        </div>
    </div>
</div>