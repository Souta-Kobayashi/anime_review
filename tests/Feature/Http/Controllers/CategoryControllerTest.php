<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Exceptions\DatabaseDestroyException;
use App\Exceptions\DatabaseUpdateException;

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

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
     */
    public function test_正常系_カテゴリ削除_成功(): void
    {
        // 初期データ登録
        $category = Category::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->deleteJson($this->path . (string) $category->id);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 200,
                'message' => 'カテゴリを削除しました'
            ]);
    }

    public function test_異常系_カテゴリ削除失敗_ユーザー未認証_ステータス401(): void
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson($this->path . (string) $category->id);

        $response->assertExactJson([
            'status' => 401,
            'message' => 'authenticate failed'
        ]);

        $this->assertGuest();
    }

    public function test_異常系_カテゴリ削除失敗_例外処理(): void
    {
        $this->expectException(DatabaseDestroyException::class);
        // 初期データ登録
        $category = Category::factory()->create();
        $user = User::factory()->create();

        // 削除対象のID　このIDはテーブルに存在しない
        $delete_id = '9999';

        $response = $this->actingAs($user)
            ->withoutExceptionHandling()
            ->deleteJson($this->path . $delete_id);

        $response->assertExactJson([
            'status' => 500,
            'message' => '想定外のエラーによりカテゴリの削除に失敗しました'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
     */
    public function test_正常系_カテゴリ更新_成功(): void
    {
        $store_category = Category::factory()->create();
        $user = User::factory()->create();
        $data = [
            'name' => $store_category->name . 'update'
        ];

        $response = $this->actingAs($user)
            ->putJson($this->path . $store_category->id, $data);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 200,
                'message' => 'カテゴリを更新しました'
            ]);
    }

    public function test_異常系_カテゴリ更新失敗_ユーザー未認証_ステータス401(): void
    {
        $store_category = Category::factory()->create();
        $data = [
            'name' => $store_category->name . 'update'
        ];

        $response = $this->putJson($this->path . $store_category->id, $data);

        $response->assertExactJson([
            'status' => 401,
            'message' => 'authenticate failed'
        ]);

        $this->assertGuest();
    }

    public function test_異常系_カテゴリ更新失敗_想定外(): void
    {
        $this->expectException(DatabaseUpdateException::class);

        $store_category = Category::factory()->create();
        $user = User::factory()->create();
        $data = [
            'name' => $store_category->name . 'update'
        ];

        // 削除対象のID　このIDはテーブルに存在しない
        $update_id = '9999';

        $response = $this->actingAs($user)
            ->withoutExceptionHandling()
            ->putJson($this->path . $update_id, $data);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 500,
                'message' => '想定外のエラーによりカテゴリの更新に失敗しました'
            ]);
    }
}
