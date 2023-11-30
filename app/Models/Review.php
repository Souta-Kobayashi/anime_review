<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Video;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'video_id',
        'watched_status',
        'review_story',
        'review_drawing',
        'review_voice_actor',
        'review_music',
        'review_characters',
        'comment',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
