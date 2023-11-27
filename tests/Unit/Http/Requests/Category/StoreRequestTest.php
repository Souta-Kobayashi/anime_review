<?php

namespace Tests\Unit\Http\Requests\Category;

use Tests\TestCase;
use App\Http\Requests\Category\StoreRequest;
use Mockery\MockInterface;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Validation\Rules\Unique;

class StoreRequestTest extends TestCase
{
    private Rule $rule;
    private Category $category;
    private StoreRequest $request;
    private array $rules;

    public function setUp(): void
    {
        parent::setUp();
        // mock

        $this->rule = $this->mock(Rule::class, function (MockInterface $mock) {
            $mock->shouldReceive('unique')->andReturn(new Unique('categories'));
        });
        $this->category = $this->mock(Category::class, function (MockInterface $mock) {
            $mock->shouldReceive('getTable')->andReturn('categories');
        });

        $this->request = new StoreRequest($this->rule, $this->category);
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
     * @dataProvider 異常系_ユニーク
     */
    public function test_異常系_ユニーク_バリデーションエラー(array $data): void
    {
        // 初期データ投入
        $category = Category::create([
            'name' => '名前重複',
        ]);

        if ($category) {
            $result = $this->validatorExec($data);
            $this->assertEquals(false, $result);
        } else {
            $this->fail('初期データの投入に失敗しました');
        }
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
                    'name' => 'testCategoryName',
                ]
            ]
        ];
    }

    /**
     * 異常系テストに投入するデータ
     */
    public static function 異常系_ユニーク(): array
    {
        return [
            '名前重複' => [
                [
                    'name' => '名前重複',
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
                ]
            ],
            'nameが空文字' => [
                [
                    'name' => '',
                ]
            ],
            'nameの文字数オーバー' => [
                [
                    'name' => str_repeat('a', 101),
                ]
            ],
        ];
    }
}
