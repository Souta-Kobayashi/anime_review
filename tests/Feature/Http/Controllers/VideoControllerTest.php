<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;

class VideoControllerTest extends TestCase
{
    private string $path = '/api/anime/create';

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
            ->postJson($this->path, $data);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 200,
                'message' => 'アニメの登録が完了しました'
            ]);
    }

    public function test_異常系_ユーザー未認証_ステータス401(): void
    {
        $data = [
            'name' => 'testAnimeName',
            'broadcast_date' => '2023年,冬アニメ',
            'genre' => 20,
            'synopsis' => 'あらすじ',
            'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
            'key_visual_reference' => 'キービジュアル引用元',
        ];

        $response = $this->post($this->path, $data);

        $response->assertExactJson([
            'status' => 401,
            'message' => 'authenticate failed'
        ]);

        $this->assertGuest();
    }
}
