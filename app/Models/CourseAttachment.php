<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class CourseAttachment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_attachments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content_id',
        'name',
        'original_name',
        'file_path',
        'file_url',
        'file_size',
        'mime_type',
        'extension',
        'description',
        'download_count',
        'is_public',
        'order_position',
        'metadata'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'file_size' => 'integer',
        'download_count' => 'integer',
        'is_public' => 'boolean',
        'order_position' => 'integer',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * File type constants
     */
    const TYPE_DOCUMENT = 'document';
    const TYPE_PRESENTATION = 'presentation';
    const TYPE_SPREADSHEET = 'spreadsheet';
    const TYPE_IMAGE = 'image';
    const TYPE_AUDIO = 'audio';
    const TYPE_VIDEO = 'video';
    const TYPE_ARCHIVE = 'archive';
    const TYPE_OTHER = 'other';

    /**
     * File category constants
     */
    const CATEGORY_LECTURE_NOTES = 'lecture_notes';
    const CATEGORY_ASSIGNMENT = 'assignment';
    const CATEGORY_REFERENCE = 'reference';
    const CATEGORY_SOLUTION = 'solution';
    const CATEGORY_TEMPLATE = 'template';
    const CATEGORY_ADDITIONAL = 'additional';

    /**
     * Scope a query to only include attachments for a specific content.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $contentId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForContent($query, $contentId)
    {
        return $query->where('content_id', $contentId);
    }

    /**
     * Scope a query to only include public attachments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope a query to only include downloadable attachments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDownloadable($query)
    {
        return $query->whereNotNull('file_path')->orWhereNotNull('file_url');
    }

    /**
     * Scope a query to order by position.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_position', 'asc')->orderBy('created_at', 'asc');
    }

    /**
     * Scope a query to filter by file type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('file_type', $type);
    }

    /**
     * Scope a query to filter by category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get the content that owns the attachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(CourseContent::class, 'content_id');
    }

    /**
     * Get the course through content.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function course()
    {
        return $this->hasOneThrough(
            Course::class,
            CourseContent::class,
            'id', // Foreign key on CourseContent table
            'id', // Foreign key on Course table
            'content_id', // Local key on CourseAttachment table
            'course_id' // Local key on CourseContent table
        );
    }

    /**
     * Get the uploader/creator of the attachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the downloads relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function downloads()
    {
        return $this->hasMany(AttachmentDownload::class, 'attachment_id');
    }

    /**
     * Determine the file type based on mime type.
     *
     * @return string
     */
    public function getFileTypeAttribute()
    {
        $mime = $this->mime_type ?? '';
        
        if (str_contains($mime, 'pdf') || str_contains($mime, 'document') || str_contains($mime, 'text')) {
            return self::TYPE_DOCUMENT;
        } elseif (str_contains($mime, 'presentation') || str_contains($mime, 'powerpoint')) {
            return self::TYPE_PRESENTATION;
        } elseif (str_contains($mime, 'spreadsheet') || str_contains($mime, 'excel')) {
            return self::TYPE_SPREADSHEET;
        } elseif (str_contains($mime, 'image')) {
            return self::TYPE_IMAGE;
        } elseif (str_contains($mime, 'audio')) {
            return self::TYPE_AUDIO;
        } elseif (str_contains($mime, 'video')) {
            return self::TYPE_VIDEO;
        } elseif (str_contains($mime, 'zip') || str_contains($mime, 'rar') || str_contains($mime, 'tar')) {
            return self::TYPE_ARCHIVE;
        } else {
            return self::TYPE_OTHER;
        }
    }

    /**
     * Get the file type icon.
     *
     * @return string
     */
    public function getFileTypeIconAttribute()
    {
        $icons = [
            self::TYPE_DOCUMENT => 'fas fa-file-alt',
            self::TYPE_PRESENTATION => 'fas fa-file-powerpoint',
            self::TYPE_SPREADSHEET => 'fas fa-file-excel',
            self::TYPE_IMAGE => 'fas fa-file-image',
            self::TYPE_AUDIO => 'fas fa-file-audio',
            self::TYPE_VIDEO => 'fas fa-file-video',
            self::TYPE_ARCHIVE => 'fas fa-file-archive',
            self::TYPE_OTHER => 'fas fa-file'
        ];
        
        return $icons[$this->file_type] ?? 'fas fa-file';
    }

    /**
     * Get the file type color.
     *
     * @return string
     */
    public function getFileTypeColorAttribute()
    {
        $colors = [
            self::TYPE_DOCUMENT => 'blue',
            self::TYPE_PRESENTATION => 'orange',
            self::TYPE_SPREADSHEET => 'green',
            self::TYPE_IMAGE => 'purple',
            self::TYPE_AUDIO => 'pink',
            self::TYPE_VIDEO => 'red',
            self::TYPE_ARCHIVE => 'yellow',
            self::TYPE_OTHER => 'gray'
        ];
        
        return $colors[$this->file_type] ?? 'gray';
    }

    /**
     * Get the file type badge class.
     *
     * @return string
     */
    public function getFileTypeBadgeClassAttribute()
    {
        $classes = [
            self::TYPE_DOCUMENT => 'bg-blue-100 text-blue-800',
            self::TYPE_PRESENTATION => 'bg-orange-100 text-orange-800',
            self::TYPE_SPREADSHEET => 'bg-green-100 text-green-800',
            self::TYPE_IMAGE => 'bg-purple-100 text-purple-800',
            self::TYPE_AUDIO => 'bg-pink-100 text-pink-800',
            self::TYPE_VIDEO => 'bg-red-100 text-red-800',
            self::TYPE_ARCHIVE => 'bg-yellow-100 text-yellow-800',
            self::TYPE_OTHER => 'bg-gray-100 text-gray-800'
        ];
        
        return $classes[$this->file_type] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Get formatted file size.
     *
     * @return string
     */
    public function getFileSizeFormattedAttribute()
    {
        if (!$this->file_size) {
            return '0 Bytes';
        }
        
        $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        $bytes = $this->file_size;
        
        for ($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get the file URL for display.
     *
     * @return string|null
     */
    public function getDisplayUrlAttribute()
    {
        if ($this->file_url) {
            return $this->file_url;
        }
        
        if ($this->file_path && Storage::exists($this->file_path)) {
            return Storage::url($this->file_path);
        }
        
        return null;
    }

    /**
     * Get the download URL.
     *
     * @return string
     */
    public function getDownloadUrlAttribute()
    {
        if ($this->file_url) {
            return $this->file_url;
        }
        
        return route('student.courses.download', [
            'courseId' => $this->course->id ?? 0,
            'attachmentId' => $this->id
        ]);
    }

    /**
     * Get the preview URL for certain file types.
     *
     * @return string|null
     */
    public function getPreviewUrlAttribute()
    {
        // For images, return the file URL
        if ($this->file_type === self::TYPE_IMAGE) {
            return $this->display_url;
        }
        
        // For PDFs, use Google Docs viewer
        if ($this->mime_type === 'application/pdf' && $this->display_url) {
            return 'https://docs.google.com/viewer?url=' . urlencode($this->display_url) . '&embedded=true';
        }
        
        return null;
    }

    /**
     * Check if file can be previewed.
     *
     * @return bool
     */
    public function getCanPreviewAttribute()
    {
        return in_array($this->file_type, [
            self::TYPE_DOCUMENT,
            self::TYPE_IMAGE,
            self::TYPE_VIDEO
        ]) && $this->display_url;
    }

    /**
     * Get the category name.
     *
     * @return string
     */
    public function getCategoryNameAttribute()
    {
        $categories = [
            self::CATEGORY_LECTURE_NOTES => 'Lecture Notes',
            self::CATEGORY_ASSIGNMENT => 'Assignment',
            self::CATEGORY_REFERENCE => 'Reference Material',
            self::CATEGORY_SOLUTION => 'Solution',
            self::CATEGORY_TEMPLATE => 'Template',
            self::CATEGORY_ADDITIONAL => 'Additional Resources'
        ];
        
        return $categories[$this->category] ?? 'Resource';
    }

    /**
     * Increment download count.
     *
     * @return $this
     */
    public function incrementDownloadCount()
    {
        $this->increment('download_count');
        
        // Log the download if we have a user
        if (auth()->check()) {
            AttachmentDownload::create([
                'attachment_id' => $this->id,
                'user_id' => auth()->id(),
                'downloaded_at' => now(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        }
        
        return $this;
    }

    /**
     * Check if file exists.
     *
     * @return bool
     */
    public function fileExists()
    {
        if ($this->file_url) {
            // For external URLs, we assume they exist
            return true;
        }
        
        if ($this->file_path) {
            return Storage::exists($this->file_path);
        }
        
        return false;
    }

    /**
     * Delete the file from storage.
     *
     * @return bool
     */
    public function deleteFile()
    {
        if ($this->file_path && Storage::exists($this->file_path)) {
            return Storage::delete($this->file_path);
        }
        
        return false;
    }

    /**
     * Get file information.
     *
     * @return array
     */
    public function getFileInfo()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'original_name' => $this->original_name,
            'type' => $this->file_type,
            'size' => $this->file_size_formatted,
            'mime_type' => $this->mime_type,
            'extension' => $this->extension,
            'download_count' => $this->download_count,
            'can_preview' => $this->can_preview,
            'preview_url' => $this->preview_url,
            'download_url' => $this->download_url,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'description' => $this->description
        ];
    }

    /**
     * Get file extension from original name.
     *
     * @return string
     */
    public function getExtensionFromName()
    {
        if ($this->original_name) {
            return pathinfo($this->original_name, PATHINFO_EXTENSION);
        }
        
        if ($this->file_path) {
            return pathinfo($this->file_path, PATHINFO_EXTENSION);
        }
        
        return '';
    }

    /**
     * Determine if file is an image.
     *
     * @return bool
     */
    public function isImage()
    {
        return $this->file_type === self::TYPE_IMAGE;
    }

    /**
     * Determine if file is a document.
     *
     * @return bool
     */
    public function isDocument()
    {
        return $this->file_type === self::TYPE_DOCUMENT;
    }

    /**
     * Determine if file is a video.
     *
     * @return bool
     */
    public function isVideo()
    {
        return $this->file_type === self::TYPE_VIDEO;
    }

    /**
     * Determine if file is an audio file.
     *
     * @return bool
     */
    public function isAudio()
    {
        return $this->file_type === self::TYPE_AUDIO;
    }

    /**
     * Get human readable type name.
     *
     * @return string
     */
    public function getHumanReadableTypeAttribute()
    {
        $types = [
            self::TYPE_DOCUMENT => 'Document',
            self::TYPE_PRESENTATION => 'Presentation',
            self::TYPE_SPREADSHEET => 'Spreadsheet',
            self::TYPE_IMAGE => 'Image',
            self::TYPE_AUDIO => 'Audio',
            self::TYPE_VIDEO => 'Video',
            self::TYPE_ARCHIVE => 'Archive',
            self::TYPE_OTHER => 'File'
        ];
        
        return $types[$this->file_type] ?? 'File';
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($attachment) {
            if (empty($attachment->name) && $attachment->original_name) {
                $attachment->name = $attachment->original_name;
            }
            
            if (empty($attachment->extension) && $attachment->original_name) {
                $attachment->extension = pathinfo($attachment->original_name, PATHINFO_EXTENSION);
            }
            
            if (empty($attachment->order_position)) {
                $maxPosition = self::where('content_id', $attachment->content_id)
                    ->max('order_position');
                $attachment->order_position = $maxPosition ? $maxPosition + 1 : 1;
            }
        });

        static::deleting(function ($attachment) {
            if ($attachment->isForceDeleting()) {
                // Delete the file from storage
                $attachment->deleteFile();
                
                // Delete download records
                $attachment->downloads()->delete();
            }
        });
    }

    /**
     * Get statistics for attachments in a course.
     *
     * @param int $courseId
     * @return array
     */
    public static function getCourseAttachmentStatistics($courseId)
    {
        $attachments = self::whereHas('content', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->get();
        
        $totalFiles = $attachments->count();
        $totalSize = $attachments->sum('file_size');
        $totalDownloads = $attachments->sum('download_count');
        
        $byType = $attachments->groupBy('file_type')->map(function ($items) {
            return [
                'count' => $items->count(),
                'total_size' => $items->sum('file_size'),
                'downloads' => $items->sum('download_count')
            ];
        });
        
        return [
            'total_files' => $totalFiles,
            'total_size' => $totalSize,
            'formatted_total_size' => self::formatBytes($totalSize),
            'total_downloads' => $totalDownloads,
            'files_by_type' => $byType,
            'average_downloads_per_file' => $totalFiles > 0 ? round($totalDownloads / $totalFiles, 2) : 0,
            'most_downloaded' => $attachments->sortByDesc('download_count')->first()
        ];
    }

    /**
     * Format bytes to human readable format.
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    private static function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}