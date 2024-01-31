<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = $this->get_review_items();
        Review::upsert($videos, ['id']);
    }

    private function get_review_items(): array
    {
        return [
            [
                'video_id' => 1,
                'watched_status' => 40,
                'review_story' => 4.5,
                'review_drawing' => 3.0,
                'review_voice_actor' => 4.0,
                'review_music' => 4.5,
                'review_characters' => 4.0,
                'comment' => '単に猟奇的な展開が続くだけだと思っていたが、話が進むにつれてミステリー要素が増してくる。前半のホラー展開の伏線を回収していく点は非常に見応えがあった。悲惨な舞台設定とは裏腹に本作が訴えかけるメッセージは非常に普遍的なものであり、そのギャップも見応えがあった。しかし作中明らかにメッセージ性が強すぎる話があるために純粋に物語を楽しめない人も出てきそうだった。そこについては好みが分かれそう。',
            ],
            [
                'video_id' => 2,
                'watched_status' => 40,
                'review_story' => 4.5,
                'review_drawing' => 4.0,
                'review_voice_actor' => 4.0,
                'review_music' => 3.5,
                'review_characters' => 3.5,
                'comment' => 'タイプリープ作品。一つのカテゴリとなるほど散々擦られてきたテーマだったが本作が他と違うのは様々な要素がミックスされたハイブリッドな点だったと思う。前半はホラー感が強めだがその後ミステリー感が強くなる。その後はバトル漫画となり恋愛模様も描かれる。様々な要素を詰め込んでいるのだが話がまとまっていて良かった。物語の全貌を一度で理解することはおそらく難しいが、矛盾なくストーリーが展開されていったと思う。',
            ],
            [
                'video_id' => 3,
                'watched_status' => 40,
                'review_story' => 3.5,
                'review_drawing' => 3.0,
                'review_voice_actor' => 3.5,
                'review_music' => 4.5,
                'review_characters' => 4.0,
                'comment' => '中二病的な世界観であり好みは分かれる。自分も最初は物語にあまり興味はなく、川井憲次氏の音楽が好きで見始めた。やはり音楽は非常に作中にハマっていたように思う。話を追うごとにセイバーと士郎の絆に心を打たれるようになった。最後の二人のシーンは感動した。',
            ],
            [
                'video_id' => 4,
                'watched_status' => 40,
                'review_story' => 4.0,
                'review_drawing' => 4.0,
                'review_voice_actor' => 4.5,
                'review_music' => 3.5,
                'review_characters' => 4.0,
                'comment' => '劇場版1作目。1期の槙島の事件以来失踪した狡噛と常守が再会する。やっぱりPSYCHO-PASSといえば狡噛と常守の物語だなと思い知らされた。誰もが最大幸福を得られるようになったシビュラシステムを紛争地域の海外に輸出する。SFの世界観を持ちながらも、政治・軍事・宗教・文化などに触れており非常に現実的な物語を展開しているように感じた。唯一狡噛が強すぎるのがいささか現実離れしているが、主人公だし、格好いいしでこれはこれでアリ。',
            ],
            [
                'video_id' => 5,
                'watched_status' => 40,
                'review_story' => 4.0,
                'review_drawing' => 3.5,
                'review_voice_actor' => 4.0,
                'review_music' => 5.0,
                'review_characters' => 3.5,
                'comment' => 'まずとにかく音楽が良すぎる。作曲を担当している澤野さんを初めて知った作品だが、初めて聞いたときに衝撃が走ったのを覚えている。火星側の圧倒的な能力を持った機体が侵略してきた時の絶望感が凄かった。しかし、地球の一切の特殊能力も積んでいない一般の練習機が、火星の超技術を導入した機体を相手に、戦略とチームプレイで立ち向かっていくところにカタルシスを感じた。2クールの作品だが、特に1クール目だけ切り取ると確実に名作だと思う。互いの目的は同じだったはずなのに、少しずつ対立していく伊奈帆とスレインの構図は悲しく見応えがあった。',
            ],
            [
                'video_id' => 6,
                'watched_status' => 40,
                'review_story' => 5.0,
                'review_drawing' => 3.5,
                'review_voice_actor' => 4.5,
                'review_music' => 4.5,
                'review_characters' => 4.5,
                'comment' => '「泣けるアニメ」の代表格として知られているが、噂に違わず感動するシーンがたくさんある。作品を通して家族愛を訴えているように感じた。余程の変わり者以外どこかで泣ける話があるはず。朋也が忌み嫌っていた自身の父親と、現在の朋也自身が同じ状況に陥っていると気が付くシーンが印象的だった。親は完璧な存在などではなくただの人間であり、親という役割を生身の人間が必死で演じているんだなと見ていた感じた。某掲示板で「CLANNADは人生」と書き込んだ人がいたがまさにその通り。',
            ],
            [
                'video_id' => 7,
                'watched_status' => 40,
                'review_story' => 3.5,
                'review_drawing' => 3.5,
                'review_voice_actor' => 4.0,
                'review_music' => 3.5,
                'review_characters' => 4.5,
                'comment' => 'タイトル通り女子高生という貴重な時間を無駄にし続ける、非常にくだらなく面白い日常系アニメ。誰もが多かれ少なかれ貴重な学生時代を無駄づかいした経験があると思うので、面白いと同時に少しノスタルジックな気持ちになる。登場人物全員キャラが濃くていい。続編が見たい。',
            ],
            [
                'video_id' => 8,
                'watched_status' => 40,
                'review_story' => 4.0,
                'review_drawing' => 4.0,
                'review_voice_actor' => 4.5,
                'review_music' => 3.5,
                'review_characters' => 4.5,
                'comment' => 'とにかく言葉遊びが面白く、当時見終わった後思わず原作を買ってしまったのを覚えている。キャラがみんな個性があって可愛い。しかし話は意外にも重たい。宗教に没頭して崩壊した家族や、ネグレクト、事故で命を落とすも成仏できない少女など、それぞれが抱えている問題を阿良々木くんが解決する。阿良々木くんの純粋さに心を打たれた。',
            ],
            [
                'video_id' => 9,
                'watched_status' => 40,
                'review_story' => 5.0,
                'review_drawing' => 3.5,
                'review_voice_actor' => 5.0,
                'review_music' => 4.5,
                'review_characters' => 4.5,
                'comment' => 'オカリンの中二病キャラが最初は非常に痛々しく感じるが、徐々に話が重くなってくるので結果的には物語として調和が取れていたと思う。いくつも張られた伏線が一気に回収される展開は圧巻だった。相当に話が作り込まれており鳥肌が立つレベルだった、SFの傑作。タイムリープ系の作品はいくつか見てきたがこれを超える作品は今のところない。仲間との絆や変えられない運命に立ち向かう勇気を教えてくれる作品だった。自分だけが悲惨な未来を知ってしまうってどういう気持ちだろうか？',
            ],
            [
                'video_id' => 10,
                'watched_status' => 40,
                'review_story' => 4.0,
                'review_drawing' => 5.0,
                'review_voice_actor' => 4.0,
                'review_music' => 4.5,
                'review_characters' => 3.5,
                'comment' => 'ストーリーだけでなく作画が素晴らしかった。戦闘シーンやOPなどは製作陣の拘りを感じた。また音楽も安定の澤野氏の音楽で臨場感があった。戦場でシンとレーナが出会うところは感動した。続きが気になる。',
            ],
        ];
    }
}
