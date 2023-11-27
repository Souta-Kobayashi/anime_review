<?php

namespace Tests\Unit\UseCases\Category;

use Tests\TestCase;
use Mockery\MockInterface;
use App\UseCases\Category\DestroyAction;
use App\Exceptions\DatabaseDestroyException;
use App\Models\Category;


class DestroyActionTest extends TestCase
{
    private Category $category;

    public function test_正常系_削除成功(): void
    {
        // 初期データ登録
        $this->category = Category::factory()->create();

        $destroyAction = new DestroyAction();
        $result = $destroyAction(new Category, $this->category->id);
        $this->assertInstanceOf(Category::class, $result);
    }

    public function test_異常系_削除失敗_例外処理(): void
    {
        // mock
        $this->category = $this->mock(Category::class, function (MockInterface $mock) {
            $mock->shouldReceive('destroy')->andReturn(null);
        });
        $this->expectException(DatabaseDestroyException::class);
        // 削除対象のID
        $delete_id = 1;
        $destroyAction = new DestroyAction();
        $destroyAction($this->category, $delete_id);

        \Mockery::close();
    }
}
