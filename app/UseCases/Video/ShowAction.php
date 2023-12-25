<?php

namespace App\UseCases\Video;

use App\Models\Video;

class ShowAction
{
    public function __invoke(Video $video, int $id): array
    {
        $video = $video->findOrFail($id);

        return [
            'id' => $video->id,
            'anime_name' => $video->name,
            'broadcast_date' => $video->broadcast_date,
            'categories' => $this->get_categories($video),
            'comment' => $video->review->comment,
            'genre' => $video->genre,
            'synopsis' => $video->synopsis,
            'key_visual' => $video->key_visual_url,
            'key_visual_reference' => $video->key_visual_reference,
            'review_average' => $this->get_video_rating($video),
            'review_story' => (float) $video->review->review_story,
            'review_drawing' => (float) $video->review->review_drawing,
            'review_voice_actor' => (float) $video->review->review_voice_actor,
            'review_music' => (float) $video->review->review_music,
            'review_characters' => (float) $video->review->review_characters,
            'watched_status' => $video->review->watched_status,
        ];
    }

    /**
     * リレーションからカテゴリを取得
     *
     * @param  Video  $video アニメのモデル
     */
    public function get_categories($video): array
    {
        return $video->categories->map(function ($category) {
            return [
                'id' => $category->id,
                'category_name' => $category->name,
            ];
        })->toArray();
    }

    /**
     * レビューの平均値を取得
     *
     * @param  Video  $video アニメのモデル
     */
    public function get_video_rating($video): float|int
    {
        return $video->get_average_rating();
    }
}
