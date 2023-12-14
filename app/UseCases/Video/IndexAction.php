<?php

namespace App\UseCases\Video;

use App\Models\Video;

class IndexAction
{
    public function __invoke(): array
    {
        // 登録日を降順でソートし一覧取得
        $videos = Video::with(['categories', 'review'])->get()->sortByDesc('created_at');

        return $videos->map(function ($video) {
            return [
                'id' => $video->id,
                'anime_name' => $video->name,
                'synopsis' => $video->synopsis,
                'key_visual' => $video->key_visual_url,
                'key_visual_reference' => $video->key_visual_reference,
                'category' => $video->categories->pluck('name')->toArray(),
                'rating' => $this->get_video_rating($video),
            ];
        })->all();
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
