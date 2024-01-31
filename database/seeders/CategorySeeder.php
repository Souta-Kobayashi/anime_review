<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = $this->build_category($this->get_category_items());
        Category::upsert($categories, ['id']);
    }

    private function build_category(array $category_names): array
    {
        return array_map(function ($name) {
            return ['name' => $name];
        }, $category_names);
    }

    private function get_category_items(): array
    {
        return [
            'アクション',
            'バトル',
            'ファンタジー',
            'SF',
            'ロボット',
            'コメディ/ギャグ',
            '恋愛',
            'ラブコメ',
            '日常',
            'ほのぼの',
            'スポーツ',
            '競技',
            '学園',
            '青春',
            'ホラー',
            'サスペンス',
            'ミステリー',
            '推理',
            '歴史',
            '戦記',
            '戦争',
            'ミリタリー',
            '家族',
            '仕事',
        ];
    }
}
