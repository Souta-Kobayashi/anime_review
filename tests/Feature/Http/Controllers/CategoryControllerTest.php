<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Exceptions\DatabaseDestroyException;

class CategoryControllerTest extends TestCase
{
    private string $path = '/api/category/';

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
     */
    public function test_正常系_カテゴリ登録_成功(): void
    {
        $data = [
            'name' => 'testCategoryName',
        ];

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson($this->path . 'create', $data);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 200,
                'message' => 'カテゴリの登録が完了しました'
            ]);
    }

    public function test_異常系_カテゴリ登録失敗_ユーザー未認証_ステータス401(): void
    {
        $data = [
            'name' => 'testAnimeName',
        ];

        $response = $this->post($this->path . 'create', $data);

        $response->assertExactJson([
            'status' => 401,
            'message' => 'authenticate failed'
        ]);

        $this->assertGuest();
    }
}
