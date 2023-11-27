<?php

namespace Tests\Unit\Http\Requests\Video;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\Video\StoreRequest;
use Mockery\MockInterface;
use App\Models\Video;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Validation\Rules\In;
use \Illuminate\Validation\Rules\Unique;

class StoreRequestTest extends TestCase
{
    private Rule $rule;
    private Video $video;
    private StoreRequest $request;
    private array $rules;

    public function setUp(): void
    {
        parent::setUp();

        // mock
        $this->rule = $this->mock(Rule::class, function (MockInterface $mock) {
            $mock->shouldReceive('unique')->andReturn(new Unique('videos'));
            $mock->shouldReceive('in')->andReturn(new In([10, 20]));
        });
        $this->video = $this->mock(Video::class, function (MockInterface $mock) {
            $mock->shouldReceive('getTable')->andReturn('videos');
        });

        $this->request = new StoreRequest($this->rule, $this->video);
        // フォームリクエストで定義したルールを取得
        $this->rules = $this->request->rules();
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }

    /*
    |--------------------------------------------------------------------------
    | Test
    |--------------------------------------------------------------------------
     */

    /**
     * バリデーションの実行
     * @return bool バリデーショルールを満たしている場合はtrue、満たしていな場合はfalseが返る
     */
    public function validatorExec($data): bool
    {
        // Validatorファサードでバリデーターのインスタンスを取得、その際に入力情報とバリデーションルールを引数で渡す
        $validator = Validator::make($data, $this->rules);
        return $validator->passes();
    }

    /**
     * @param array $data 投入データの連想配列
     * @dataProvider 正常系のデータ
     */
    public function test_正常系バリデーション(array $data): void
    {
        $result = $this->validatorExec($data);
        $this->assertEquals(true, $result);
    }

    /**
     * @param array $data 投入データの連想配列
     * @dataProvider 異常系のデータ
     */
    public function test_異常系バリデーション(array $data): void
    {
        $result = $this->validatorExec($data);
        $this->assertEquals(false, $result);
    }

    /**
     * @param array $data 投入データの連想配列
     * @dataProvider 異常系_ユニークバリデーション
     */
    public function test_異常系ユニークデータ_バリデーション(array $data): void
    {
        // 初期データ投入
        $video = Video::create([
            'name' => '名前重複',
        ]);
        if ($video) {
            $result = $this->validatorExec($data);
            $this->assertEquals(false, $result);
        } else {
            $this->fail('初期データの投入に失敗しました');
        }
    }

    /**
     * @param array $data 投入データの連想配列
     * @dataProvider makeVideoDataProvider
     */
    public function test_makeVideo(array $data): void
    {
        $videoInstance = $this->request->make_video($data);

        // Videoインスタンスが正しく生成された
        $this->assertInstanceOf(Video::class, $videoInstance);
        // Videoインスタンスの各プロパティが期待通りの値か
        $this->assertMatchesRegularExpression(
            "/^((\d{4}年\s)?(春|夏|秋|冬)アニメ|^\d{4}年)?$/",
            $videoInstance->broadcast_date
        );
        // key_visual_imageが期待通りに保存されているか
        $this->assertFileExists('/var/www/public/storage/uploads/' . $videoInstance->key_visual_url);
    }

    /*
    |--------------------------------------------------------------------------
    | Data Provider
    |--------------------------------------------------------------------------
    */

    /**
     * 正常系テストに投入するデータ
     */
    public static function 正常系のデータ(): array
    {
        return [
            [
                [
                    'name' => 'testAnimeName',
                    'broadcast_date' => '2023年,冬アニメ',
                    'genre' => 20,
                    'synopsis' => 'あらすじ',
                    'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
                    'key_visual_reference' => 'キービジュアル引用元',
                ]
            ]
        ];
    }

    /**
     * test_makeVideoに投入するデータ
     */
    public static function makeVideoDataProvider(): array
    {
        return [
            'broadcast_dateが両方入力されている' => [
                [
                    'name' => 'Test Video',
                    'broadcast_date' => '2023年,冬アニメ',
                    'key_visual_image' => UploadedFile::fake()->image('test-image.jpg'),
                ]
            ],
            'broadcast_dateの西暦抜け' => [
                [
                    'name' => 'Test Video',
                    'broadcast_date' => ',冬アニメ',
                    'key_visual_image' => null,
                ]
            ],
            'broadcast_dateの季節抜け' => [
                [
                    'name' => 'Test Video',
                    'broadcast_date' => '2023年,',
                    'key_visual_image' => null,
                ]
            ],
            'broadcast_dateの未入力時カンマのみ入る' => [
                [
                    'name' => 'Test Video',
                    'broadcast_date' => ',',
                    'key_visual_image' => null,
                ]
            ],
        ];
    }

    /**
     * 異常系テストに投入するデータ
     */
    public static function 異常系_ユニークバリデーション(): array
    {
        return [
            '名前重複' => [
                [
                    'name' => '名前重複',
                    'broadcast_date' => '2023年　冬アニメ',
                    'genre' => 20,
                    'synopsis' => 'あらすじ',
                    'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
                    'key_visual_reference' => 'キービジュアル引用元',
                ]
            ],
        ];
    }

    /**
     * 異常系テストに投入するデータ
     */
    public static function 異常系のデータ(): array
    {
        return [
            'nameがnull' => [
                [
                    'name' => null,
                    'broadcast_date' => '2023年　冬アニメ',
                    'genre' => 20,
                    'synopsis' => 'あらすじ',
                    'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
                    'key_visual_reference' => 'キービジュアル引用元',
                ]
            ],
            'nameの文字数オーバー' => [
                [
                    'name' => str_repeat('a', 401),
                    'broadcast_date' => '2023年　冬アニメ',
                    'genre' => 20,
                    'synopsis' => 'あらすじ',
                    'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
                    'key_visual_reference' => 'キービジュアル引用元',
                ]
            ],
            'broadcast_dateの文字数オーバー' => [
                [
                    'name' => 'testAnimeName',
                    'broadcast_date' => str_repeat('a', 101),
                    'genre' => 20,
                    'synopsis' => 'あらすじ',
                    'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
                    'key_visual_reference' => 'キービジュアル引用元',
                ]
            ],
            'genreの制約外の値' => [
                [
                    'name' => 'testAnimeName',
                    'broadcast_date' => '2023年　冬アニメ',
                    'genre' => 30,
                    'synopsis' => 'あらすじ',
                    'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
                    'key_visual_reference' => 'キービジュアル引用元',
                ]
            ],
            'synopsisの文字数オーバー' => [
                [
                    'name' => 'testAnimeName',
                    'broadcast_date' => '2023年　冬アニメ',
                    'genre' => 20,
                    'synopsis' => str_repeat('a', 10001),
                    'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
                    'key_visual_reference' => 'キービジュアル引用元',
                ]
            ],
            'key_visual_imageに画像以外の拡張子' => [
                [
                    'name' => 'testAnimeName',
                    'broadcast_date' => '2023年　冬アニメ',
                    'genre' => 20,
                    'synopsis' => 'あらすじ',
                    'key_visual_image' => UploadedFile::fake()->create('dummy.xlsx'),
                    'key_visual_reference' => 'キービジュアル引用元',
                ]
            ],
            'key_visual_referenceの文字数オーバー' => [
                [
                    'name' => 'testAnimeName',
                    'broadcast_date' => '2023年　冬アニメ',
                    'genre' => 20,
                    'synopsis' => 'あらすじ',
                    'key_visual_image' => UploadedFile::fake()->image('dummy.jpg')->size(5 * 1024),
                    'key_visual_reference' => str_repeat('a', 451),
                ]
            ],
        ];
    }
}
