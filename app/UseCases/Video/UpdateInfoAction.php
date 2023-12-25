<?php

namespace App\UseCases\Video;

use App\Models\Review;
use App\Models\Video;
use Exception;

class UpdateInfoAction
{
    public function __invoke(Video $video, array $anime_info_item, string $video_id): Review|bool
    {
        $target_video = $video->findOrFail($video_id);

        // 更新データを判定し各メソッドで更新処理を実行
        if ($this->requires_review_update($anime_info_item)) {
            $result = $this->update_or_create_review($target_video, $anime_info_item);
        } elseif ($this->requires_category_update($anime_info_item)) {
            $result = $this->update_categories($target_video, $anime_info_item['categories']);
        } else {
            $result = $this->update_video($target_video, $anime_info_item);
        }

        if (! $result) {
            throw new Exception;
        }

        return $result;
    }

    /**
     * @param  array  $anime_info_item  更新対象のデータ
     */
    private function requires_review_update(array $animeInfoItem): bool
    {
        return array_key_exists('comment', $animeInfoItem)
            || array_key_exists('watched_status', $animeInfoItem);
    }

    /**
     * @param  array  $anime_info_item  更新対象のデータ
     */
    private function requires_category_update(array $anime_info_item): bool
    {
        return array_key_exists('categories', $anime_info_item);
    }

    /**
     * @param  Video  $video               更新対象のvideo
     * @param  array  $update_review_data  更新するvideoデータ
     */
    private function update_or_create_review(Video $video, array $update_review_data): Review
    {
        $review = $video->review ?? new Review;
        $review->fill($update_review_data);
        $video->review()->save($review);

        return $review;
    }

    /**
     * @param  Video  $video       更新対象のvideo
     * @param  array  $categories  更新するカテゴリデータ
     */
    private function update_categories(Video $video, array $categories): bool
    {
        $category_ids = array_column($categories, 'id');
        $video->categories()->sync($category_ids);

        // 例外が発生しなければ正常終了したとみなす
        return true;
    }

    /**
     * @param  Video  $video              更新対象のvideo
     * @param  array  $update_video_data  更新するvideoデータ
     */
    private function update_video(Video $video, array $update_video_data): bool
    {
        $video->fill($update_video_data);

        return $video->save();
    }
}
