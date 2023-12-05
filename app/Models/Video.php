<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $fillable = [
        'name',
        'broadcast_date',
        'genre',
        'synopsis',
        'key_visual_url',
        'key_visual_reference',
    ];

    // アニメのソフトデリート時にreviewのレコードもソフトデリート
    protected $softCascade = ['review'];

    public function categories(): BelongsToMany
    {
        return $this->BelongsToMany(Category::class, 'videos_categories');
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}
