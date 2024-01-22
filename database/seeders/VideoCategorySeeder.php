<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $videos_with_categories = $this->get_videos_categories_items();

            foreach ($videos_with_categories as $video_with_categories) {
                $video = Video::where(
                    'name', $video_with_categories['video_name']
                )->first();

                if ($video) {
                    $this->attach_categories(
                        $video, $video_with_categories['categories']
                    );
                }
            }
        });
    }

    private function attach_categories($video, $categories): void
    {
        $category_ids = Category::whereIn('name', $categories)->pluck('id');
        $video->categories()->attach($category_ids);
    }

    private function get_videos_categories_items(): array
    {
        return [
            [
                'video_name' => 'ひぐらしのなく頃に',
                'categories' => [
                    'ファンタジー',
                    'ホラー',
                    'サスペンス',
                    'ミステリー',
                    '推理',
                ],
            ],
            [
                'video_name' => 'サマータイムレンダ',
                'categories' => [
                    'バトル',
                    'ファンタジー',
                    'サスペンス',
                    'ミステリー',
                ],
            ],
            [
                'video_name' => 'Fate/stay night',
                'categories' => [
                    'アクション',
                    'バトル',
                    'ファンタジー',
                    '戦記',
                ],
            ],
            [
                'video_name' => '劇場版 PSYCHO-PASS サイコパス',
                'categories' => [
                    'バトル',
                    'SF',
                    '戦争',
                ],
            ],
            [
                'video_name' => 'アルドノア・ゼロ',
                'categories' => [
                    'アクション',
                    'バトル',
                    'SF',
                    'ロボット',
                    '戦争',
                ],
            ],
            [
                'video_name' => 'CLANNAD',
                'categories' => [
                    '恋愛',
                    '学園',
                    '家族',
                ],
            ],
            [
                'video_name' => '女子高生の無駄づかい',
                'categories' => [
                    'コメディ/ギャグ',
                    '日常',
                    'ほのぼの',
                    '学園',
                    '青春',
                ],
            ],
            [
                'video_name' => '化物語',
                'categories' => [
                    'ファンタジー',
                    'ラブコメ',
                    '学園',
                    '青春',
                ],
            ],
            [
                'video_name' => 'STEINS;GATE',
                'categories' => [
                    'SF',
                ],
            ],
            [
                'video_name' => '86-エイティシックス-',
                'categories' => [
                    'アクション',
                    'バトル',
                    'ファンタジー',
                    'ロボット',
                    '戦争',
                    'ミリタリー',
                ],
            ],
        ];
    }
}
