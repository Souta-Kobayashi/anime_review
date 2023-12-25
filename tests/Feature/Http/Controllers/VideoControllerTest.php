<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use App\Models\Video;
use App\Exceptions\DatabaseDestroyException;
use App\Exceptions\DatabaseUpdateException;

class VideoControllerTest extends TestCase
{
    private string $path = '/api/anime/';

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
     */
    public function test_正常系_アニメ登録_成功(): void
    {
        $data = [
            'name' => 'testAnimeName',
            'broadcast_date' => '2023年,冬アニメ',
            'genre' => 20,
            'synopsis' => 'あらすじ',
            'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
            'key_visual_reference' => 'キービジュアル引用元',
        ];

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson($this->path . 'create', $data);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 200,
                'message' => 'アニメの登録が完了しました'
            ]);
    }

    public function test_異常系_アニメ登録失敗_ユーザー未認証_ステータス401(): void
    {
        $data = [
            'name' => 'testAnimeName',
            'broadcast_date' => '2023年,冬アニメ',
            'genre' => 20,
            'synopsis' => 'あらすじ',
            'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
            'key_visual_reference' => 'キービジュアル引用元',
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
    public function test_正常系_アニメ削除_成功(): void
    {
        // 初期データ登録
        $video = Video::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->deleteJson($this->path . (string) $video->id);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 200,
                'message' => 'アニメを削除しました'
            ]);
    }

    public function test_異常系_アニメ削除失敗_ユーザー未認証_ステータス401(): void
    {
        $video = Video::factory()->create();

        $response = $this->deleteJson($this->path . (string) $video->id);

        $response->assertExactJson([
            'status' => 401,
            'message' => 'authenticate failed'
        ]);

        $this->assertGuest();
    }

    public function test_異常系_アニメ削除失敗_例外処理(): void
    {
        $this->expectException(DatabaseDestroyException::class);
        // 初期データ登録
        $video = Video::factory()->create();
        $user = User::factory()->create();

        // 削除対象のID　このIDはテーブルに存在しない
        $delete_id = '9999';

        $response = $this->actingAs($user)
            ->withoutExceptionHandling()
            ->deleteJson($this->path . $delete_id);

        $response->assertExactJson([
            'status' => 500,
            'message' => '想定外のエラーによりアニメの削除に失敗しました'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | update_rating
    |--------------------------------------------------------------------------
     */
    public function test_正常系_レーティング更新_成功(): void
    {
        $data = [
            "review_story" => "3.0",
            "review_drawing" => "3.0",
            "review_voice_actor" => "3.0",
            "review_music" => "3.0",
            "review_characters" => "3.0"
        ];

        // 初期データ登録
        $video = Video::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->putJson(
                $this->path . (string) $video->id . '/rating',
                $data
            );

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 200,
                'message' => 'アニメのレビューが完了しました'
            ]);
    }

    public function test_異常系_レーティング更新失敗_ユーザー未認証_ステータス401(): void
    {
        $data = [
            "review_story" => "3.0",
            "review_drawing" => "3.0",
            "review_voice_actor" => "3.0",
            "review_music" => "3.0",
            "review_characters" => "3.0"
        ];

        $video = Video::factory()->create();

        $response = $this->putJson(
            $this->path . (string) $video->id . '/rating',
            $data
        );

        $response->assertExactJson([
            'status' => 401,
            'message' => 'authenticate failed'
        ]);

        $this->assertGuest();
    }

    public function test_異常系_レーティング更新失敗_例外処理(): void
    {
        $data = [
            "review_story" => "3.0",
            "review_drawing" => "3.0",
            "review_voice_actor" => "3.0",
            "review_music" => "3.0",
            "review_characters" => "3.0"
        ];

        $this->expectException(DatabaseUpdateException::class);
        // 初期データ登録
        $video = Video::factory()->create();
        $user = User::factory()->create();

        // 削除対象のID　このIDはテーブルに存在しない
        $update_id = '9999';

        $response = $this->actingAs($user)
            ->withoutExceptionHandling()
            ->putJson(
                $this->path . $update_id . '/rating',
                $data
            );

        $response->assertExactJson([
            'status' => 500,
            'message' => '想定外のエラーによりレビューの更新に失敗しました'
        ]);
    }
}
