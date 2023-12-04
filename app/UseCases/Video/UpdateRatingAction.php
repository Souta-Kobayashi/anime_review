<?php

namespace App\UseCases\Video;

use App\Models\Review;
use App\Models\Video;
use Exception;

class UpdateRatingAction
{
    public function __invoke(Review $review_rating, Video $video, string $video_id): Review
    {
        $video->findOrFail($video_id);
        $review_rating->video_id = $video_id;

        if (!$review_rating->save()) {
            throw new Exception;
        }
        return $review_rating;
    }
}
