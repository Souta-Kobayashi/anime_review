<?php

namespace Tests\Unit\UseCases\Video;

use Tests\TestCase;
use Mockery\MockInterface;
use App\UseCases\Video\DestroyAction;
use App\Exceptions\DatabaseDestroyException;
use App\Models\Video;


class DestroyActionTest extends TestCase
{
    private Video $video;

    public function test_正常系_削除成功(): void
    {
        // 初期データ登録
        $this->video = Video::factory()->create();

        $destroyAction = new DestroyAction();
        $result = $destroyAction(new Video, $this->video->id);
        $this->assertInstanceOf(Video::class, $result);
    }

    public function test_異常系_削除失敗_例外処理(): void
    {
        // mock
        $this->video = $this->mock(Video::class, function (MockInterface $mock) {
            $mock->shouldReceive('destroy')->andReturn(null);
        });
        $this->expectException(DatabaseDestroyException::class);
        // 削除対象のID
        $delete_id = 1;
        $destroyAction = new DestroyAction();
        $destroyAction($this->video, $delete_id);

        \Mockery::close();
    }
}
