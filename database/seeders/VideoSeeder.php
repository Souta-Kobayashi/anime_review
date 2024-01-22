<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = $this->get_video_items();
        Video::upsert($videos, ['id']);
    }

    private function get_video_items(): array
    {
        return [
            [
                'name' => 'ひぐらしのなく頃に',
                'broadcast_date' => '2006年 春アニメ',
                'genre' => 10,
                'synopsis' => '雛見沢村を舞台に、村にまつわる古い因習「綿流し」を軸にして起こる連続怪死・失踪事件を扱った連作式のミステリー。謎が提示される「出題編」と、事件の真相と謎に対する「解答編」として話が構成される。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
            [
                'name' => 'サマータイムレンダ',
                'broadcast_date' => '2022年 春アニメ',
                'genre' => 10,
                'synopsis' => '網代慎平は幼馴染・小舟潮の訃報を聞き、葬儀に参列するために2年ぶりに生まれ育った故郷・日都ヶ島（ひとがしま）に戻る。潮は事故で亡くなったと聞いていたが潮の死には不可解な点があり、他殺の可能性が浮上する。その背後に見え隠れするのは日都ヶ島に昔から伝わる「見たものは死ぬ」と言われる「影」の存在だった。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
            [
                'name' => 'Fate/stay night',
                'broadcast_date' => '2006年 冬アニメ',
                'genre' => 10,
                'synopsis' => '日本の地方都市「冬木市」で数十年に一度現れるあらゆる願いを叶える「聖杯」。7人の魔術師が7騎のサーヴァントと契約し、聖杯を巡る争い「聖杯戦争」で争う。遠坂凛は前回の聖杯戦争で命を落とした父の遺志を継ぎ、聖杯戦争に挑む。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
            [
                'name' => '劇場版 PSYCHO-PASS サイコパス',
                'broadcast_date' => '2015年',
                'genre' => 20,
                'synopsis' => '2116年、東南アジア連合（SEAUn、シーアン）は、紛争地帯の首都に日本のシビュラシステムを導入し、平和を迎えた。そんなある日、武装した不審な集団が日本に侵入する。常守朱率いる公安局が出動し対峙する。テロリストの一員にモンタージュを行うと、密入国の指示者と思しき人物が浮上するが、それは朱の元同僚・狡噛慎也だった。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
            [
                'name' => 'アルドノア・ゼロ',
                'broadcast_date' => '2014年 夏アニメ',
                'genre' => 10,
                'synopsis' => '西暦2014年、地球と火星の戦争から15年後。休戦から10年以上が経った現在も地球側と火星側の和平交渉が進められていた。火星の皇女アセイラム姫は和平を望み、地球で親善パレードを行うが、突如テロリストに襲撃される。偶然、彼女を助けた界塚伊奈帆は地球を救うために練習機で火星の超技術を導入したロボットに立ち向かう。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
            [
                'name' => 'CLANNAD',
                'broadcast_date' => '2007年 秋アニメ',
                'genre' => 10,
                'synopsis' => '怪我でバスケットボールを諦め、不良に転落した主人公・岡崎朋也。ある日、学園前の坂道で彼は女子生徒・古河渚と遭遇する。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
            [
                'name' => '女子高生の無駄づかい',
                'broadcast_date' => '2019年 夏アニメ',
                'genre' => 10,
                'synopsis' => 'いつの間にか疎遠になっていた三人、田中・菊池・鷺宮。数年後、三人はさいのたま女子高等学校で再会する。彼女らを中心に、個性豊かなクラスメイトたちとともに、『女子高生』が『無駄』だらけの日々を繰り広げていく。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
            [
                'name' => '化物語',
                'broadcast_date' => '2009年 夏アニメ',
                'genre' => 10,
                'synopsis' => '高校3年生の阿良々木暦は春休みの『事件』以来、人とは異なる部分を持っていた。文化祭の準備を進めていたある5月、病弱なクラスメイト戦場ヶ原ひたぎの秘密を知る。彼女には、およそ体重と呼べるものがほとんど無かった。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
            [
                'name' => 'STEINS;GATE',
                'broadcast_date' => '2011年 春アニメ',
                'genre' => 10,
                'synopsis' => '未来ガジェット研究所の岡部倫太郎は、仲間たちと奇妙な発明に没頭していた。2010年7月28日、天才科学者・牧瀬紅莉栖と出会うが、後に刺され血まみれになった彼女を発見。それをメールで友人に連絡した直後、眩暈に襲われる。また、先ほど送信したはずのメールの日付が5日前になっており、周囲と岡部の記憶は一致しない。さらに刺殺されたはずの紅莉栖が岡部の前に現れる。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
            [
                'name' => '86-エイティシックス-',
                'broadcast_date' => '2021年 春アニメ',
                'genre' => 10,
                'synopsis' => '星歴2148年、サンマグノリア共和国はギアーデ帝国の無人兵器「レギオン」に対抗し、同様の無人兵器「ジャガーノート」を投入した。しかし、その実態は白系種以外を人間と見做さない差別思想により生み出された「有人搭乗式無人機」で、彼らは共和国85行政区の外へ追いやられた「エイティシックス」と蔑まれながら戦い続けていた。',
                'key_visual_url' => null,
                'key_visual_reference' => null,
            ],
        ];
    }
}
