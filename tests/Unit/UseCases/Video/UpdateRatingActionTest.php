<?php

namespace Tests\Unit\UseCases\Video;

use App\Models\Review;
use App\Models\Video;
use App\UseCases\Video\UpdateRatingAction;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateRatingActionTest extends TestCase
{
    public function test_正常系_update成功(): void
    {
        // 初期データ投入
        $video = Video::factory()->create();
        if (! $video) {
            $this->fail();
        }

        $review_items = [
            'review_story' => '3.0',
            'review_drawing' => '3.0',
            'review_voice_actor' => '3.0',
            'review_music' => '3.0',
            'review_characters' => '3.0',
        ];

        $update_rating_action = new UpdateRatingAction();
        $result = $update_rating_action($video, $review_items, $video->id);

        $this->assertInstanceOf(Review::class, $result);
    }

    public function test_異常系_video存在エラー_例外処理(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $review_items = [
            'review_story' => '3.0',
            'review_drawing' => '3.0',
            'review_voice_actor' => '3.0',
            'review_music' => '3.0',
            'review_characters' => '3.0',
        ];

        $video = new Video;

        $update_rating_action = new UpdateRatingAction();
        $update_rating_action($video, $review_items, '9999');
    }

    // 実装時間かかりそうなので一旦スルー
    // public function test_異常系_DB保存エラー_例外処理(): void
    // {
    //     // 初期データ投入
    //     $video = Video::factory()->create();
    //     if (! $video) {
    //         $this->fail();
    //     }

    //     $review_items = [
    //         'review_story' => '3.0',
    //         'review_drawing' => '3.0',
    //         'review_voice_actor' => '3.0',
    //         'review_music' => '3.0',
    //         'review_characters' => '3.0',
    //     ];

    //     $this->expectException(Exception::class);

    //     // mock
    //     $review = $this->partialMock(Review::class, function (MockInterface $mock) {
    //         $mock->shouldReceive('save')->andReturn(false);
    //         // $mock->shouldReceive('fill')->willReturnSelf();
    //     });
    //     $video = $this->partialMock(Video::class, function (MockInterface $mock) use ($review) {
    //         $mock->shouldReceive('review')->andReturn($review);
    //         // $mock->shouldReceive('findOrFail')->andReturn(new Video);
    //     });
    //     $param_video = $this->partialMock(Video::class, function (MockInterface $mock) use ($video) {
    //         $mock->shouldReceive('findOrFail')->andReturn($video);
    //     });

    //     $update_rating_action = new UpdateRatingAction();
    //     $update_rating_action($param_video, $review_items, $video->id);
    // }
}
