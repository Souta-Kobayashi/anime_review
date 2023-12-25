<?php

namespace Tests\Unit\UseCases\Category;

use Tests\TestCase;
use Mockery\MockInterface;
use App\UseCases\Category\UpdateAction;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateActionTest extends TestCase
{
    public function test_正常系_更新成功(): void
    {
        $store_category = Category::factory()->create();
        $storeAction = new UpdateAction();
        $result = $storeAction(new Category, $store_category->id, $store_category->name . 'updateTest');
        $this->assertInstanceOf(Category::class, $result);
    }

    public function test_異常系_存在エラー_例外処理(): void
    {
        $store_category = Category::factory()->create();
        $this->expectException(ModelNotFoundException::class);
        $storeAction = new UpdateAction();
        $storeAction(new Category, 9999, $store_category->name);
    }
}
