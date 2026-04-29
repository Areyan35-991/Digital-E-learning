<!-- Add Lesson Modal -->
<div class="modal fade" id="addLessonModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('teacher.lessons.create', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="module_id" id="addLessonModuleId">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Lesson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Module</label>
                            <select name="module_id" class="form-select" required>
                                <option value="">Select Module</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lesson Type</label>
                            <select name="type" class="form-select" id="lessonType" required>
                                <option value="reading">Reading</option>
                                <option value="video">Video</option>
                                <option value="quiz">Quiz</option>
                                <option value="assignment">Assignment</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Lesson Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="6" required placeholder="Enter lesson content..."></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duration (minutes)</label>
                            <input type="number" name="duration" class="form-control" value="30" min="1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" name="order" class="form-control" value="1" min="1">
                        </div>
                    </div>
                    
                    <!-- Video URL Field (shown only for video type) -->
                    <div class="mb-3" id="videoUrlField" style="display: none;">
                        <label class="form-label">Video URL</label>
                        <input type="url" name="video_url" class="form-control" placeholder="https://youtube.com/...">
                        <small class="text-muted">Enter YouTube, Vimeo, or other video URL</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Attachment (Optional)</label>
                        <input type="file" name="attachment" class="form-control">
                        <small class="text-muted">PDF, Word, PowerPoint, or other learning materials (Max: 10MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Lesson</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Lesson Modal -->
<div class="modal fade" id="editLessonModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="lesson_id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Lesson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Module</label>
                            <select name="module_id" class="form-select" required>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lesson Type</label>
                            <select name="type" class="form-select" id="editLessonType" required>
                                <option value="reading">Reading</option>
                                <option value="video">Video</option>
                                <option value="quiz">Quiz</option>
                                <option value="assignment">Assignment</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Lesson Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="6" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duration (minutes)</label>
                            <input type="number" name="duration" class="form-control" min="1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" name="order" class="form-control" min="1">
                        </div>
                    </div>
                    
                    <!-- Video URL Field for editing -->
                    <div class="mb-3" id="editVideoUrlField" style="display: none;">
                        <label class="form-label">Video URL</label>
                        <input type="url" name="video_url" class="form-control" placeholder="https://youtube.com/...">
                        <small class="text-muted">Enter YouTube, Vimeo, or other video URL</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Attachment</label>
                        <div class="input-group">
                            <input type="file" name="attachment" class="form-control">
                            <div class="input-group-text">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_attachment" id="removeAttachment">
                                    <label class="form-check-label" for="removeAttachment">
                                        Remove
                                    </label>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">Leave empty to keep current attachment</small>
                    </div>
                    
                    <!-- Current attachment info -->
                    <div class="alert alert-info" id="currentAttachmentInfo" style="display: none;">
                        <i class="bi bi-paperclip"></i>
                        <span id="currentAttachmentName"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Lesson</button>
                </div>
            </form>
        </div>
    </div>
</div>