<?php

namespace Tests\Unit\UseCases\Category;

use Tests\TestCase;
use Mockery\MockInterface;
use App\UseCases\Category\IndexAction;
use App\Models\Category;

class IndexActionTest extends TestCase
{
    private Category $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->category = new Category;
    }

    public function test_正常系(): void
    {
        // 初期データ投入
        $insert_categories = $this->category->factory()->count(10)->create();
        if ($insert_categories->isEmpty()) {
            $this->fail();
        }

        $storeAction = new IndexAction();
        $result = $storeAction($this->category);

        $this->assertSame($result->count(), 10);
        $this->assertEquals(
            $insert_categories->pluck('name', 'id')->all(),
            $result->pluck('name', 'id')->all()
        );
    }

    public function test_異常系_カテゴリ取得エラー_例外処理(): void
    {
        // mock
        $this->category = $this->mock(Category::class, function (MockInterface $mock) {
            $mock->shouldReceive('all')->once()->andThrow(new \Exception());
        });
        $this->expectException(\Exception::class);

        $storeAction = new IndexAction();
        $storeAction($this->category);

        \Mockery::close();
    }
}
