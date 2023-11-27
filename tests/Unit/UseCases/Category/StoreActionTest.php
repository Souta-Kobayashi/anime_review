<?php

namespace Tests\Unit\UseCases\Category;

use Tests\TestCase;
use Mockery\MockInterface;
use App\UseCases\Category\StoreAction;
use App\Exceptions\DatabaseStoreException;
use App\Models\Category;

class StoreActionTest extends TestCase
{
    private Category $category;

    public function setUp(): void
    {
        parent::setUp();
        // mock
        $this->category = $this->mock(Category::class, function (MockInterface $mock) {
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
        $storeAction($this->category);
    }
}
