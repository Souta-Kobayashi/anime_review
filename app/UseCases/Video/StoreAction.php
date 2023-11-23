<?php

namespace App\UseCases\Video;

use App\Exceptions\DatabaseStoreException;
use App\Models\Video;

class StoreAction
{
    public function __invoke(Video $video): Video
    {
        if (!$video->save()) {
            throw new DatabaseStoreException('アニメ');
        }
        return $video;
    }
}
