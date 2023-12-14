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
        return $this->BelongsToMany(Category::class, 'videos_categories')->withTimestamps();
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    /**
     * レビューの平均値を取得
     * ビジネスロジックだが汎用的な処理であるため一旦モデルに実装
     */
    public function get_average_rating(): float|int
    {
        $review = $this->review;

        if (! $review) {
            return 0;
        }

        $review_items = [
            'story' => $review->review_story,
            'drawing' => $review->review_drawing,
            'voice_actor' => $review->review_voice_actor,
            'music' => $review->review_music,
            'characters' => $review->review_characters,
        ];

        // nullが一つでもあれば計算不能として0を返す
        if (in_array(null, $review_items, true)) {
            return 0;
        }

        // 数値に変換
        $review_items = array_map(fn ($item) => (float) $item, $review_items);

        $average = array_sum($review_items) / count($review_items);

        return $average;
    }
}
