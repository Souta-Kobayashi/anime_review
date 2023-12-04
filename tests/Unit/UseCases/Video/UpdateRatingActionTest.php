<?php

namespace Tests\Unit\UseCases\Video;

use Tests\TestCase;
use Mockery\MockInterface;
use App\UseCases\Video\UpdateRatingAction;
use App\Models\Video;
use App\Models\Review;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UpdateRatingActionTest extends TestCase
{
    public function test_正常系_update成功(): void
    {
        // 初期データ投入
        $video = Video::factory()->create();
        if (!$video) {
            $this->fail();
        }

        $review = new Review;
        $review->fill([
            "review_story" => "3.0",
            "review_drawing" => "3.0",
            "review_voice_actor" => "3.0",
            "review_music" => "3.0",
            "review_characters" => "3.0"
        ]);

        $update_rating_action = new UpdateRatingAction();
        $result = $update_rating_action($review, $video, $video->id);

        $this->assertInstanceOf(Review::class, $result);
    }

    public function test_異常系_video存在エラー_例外処理(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $review = new Review;
        $review->fill([
            "review_story" => "3.0",
            "review_drawing" => "3.0",
            "review_voice_actor" => "3.0",
            "review_music" => "3.0",
            "review_characters" => "3.0"
        ]);

        $video = new Video;
        $video->id = 9999;

        $update_rating_action = new UpdateRatingAction();
        $update_rating_action($review, $video, '1');
    }

    public function test_異常系_DB保存エラー_例外処理(): void
    {
        // 初期データ投入
        $video = Video::factory()->create();
        if (!$video) {
            $this->fail();
        }

        $this->expectException(Exception::class);
        // mock
        $review = $this->mock(Review::class, function (MockInterface $mock) {
            $mock->shouldReceive('save')->andReturn(false);
        });
        $update_rating_action = new UpdateRatingAction();
        $update_rating_action($review, $video, $video->id);
    }
}
