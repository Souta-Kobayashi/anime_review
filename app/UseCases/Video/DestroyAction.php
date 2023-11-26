<?php

namespace App\UseCases\Video;

use App\Exceptions\DatabaseDestroyException;
use App\Models\Video;

class DestroyAction
{
    public function __invoke(Video $video, $id): Video
    {
        if (!$video->destroy($id)) {
            throw new DatabaseDestroyException('アニメ');
        }
        return $video;
    }
}
