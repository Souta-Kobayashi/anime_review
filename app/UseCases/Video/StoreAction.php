<?php

namespace App\UseCases\Video;

use App\Exceptions\DatabaseStoreException;
use App\Models\Review;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(Video $video, Review $review): Video
    {
        // videos, reviewsにinsertするためトランザクション処理する
        try {
            DB::beginTransaction();

            $video->save();
            $video->review()->save($review);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new DatabaseStoreException('アニメ', $e);
        }

        return $video;
    }
}
