<?php

namespace App\UseCases\Video;

use App\Models\Review;
use App\Models\Video;
use Exception;

class UpdateRatingAction
{
    public function __invoke(Video $video, array $review_items, string $video_id): Review
    {
        $target_video = $video->findOrFail($video_id);
        $review = $target_video->review ?? new Review;
        $review->fill($review_items);

        $result = $target_video->review()->save($review);
        if (! $result) {
            throw new Exception;
        }

        return $result;
    }
}
