<?php

namespace Tests\Unit\UseCases\Video;

use Tests\TestCase;
use Mockery\MockInterface;
use App\UseCases\Video\StoreAction;
use App\Exceptions\DatabaseStoreException;
use App\Models\Video;

class StoreActionTest extends TestCase
{
    private Video $video;

    public function setUp(): void
    {
        parent::setUp();
        // mock
        $this->video = $this->mock(Video::class, function (MockInterface $mock) {
            $mock->shouldReceive('save')->andReturn(false);
        });
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_異常系_DB保存エラー_例外処理(): void
    {
        $this->expectException(DatabaseStoreException::class);
        $storeAction = new StoreAction();
        $storeAction($this->video);
    }
}
