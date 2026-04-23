<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentDownload extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attachment_downloads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'attachment_id',
        'user_id',
        'downloaded_at',
        'ip_address',
        'user_agent'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'downloaded_at' => 'datetime'
    ];

    /**
     * Get the attachment that was downloaded.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attachment()
    {
        return $this->belongsTo(CourseAttachment::class, 'attachment_id');
    }

    /**
     * Get the user who downloaded.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}