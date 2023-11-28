<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'broadcast_date',
        'genre',
        'synopsis',
        'key_visual_url',
        'key_visual_reference',
    ];

    public function categories(): BelongsToMany
    {
        return $this->BelongsToMany(Category::class, 'videos_categories');
    }
}