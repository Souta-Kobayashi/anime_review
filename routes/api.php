<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/isLoggedIn', function () {
        return response()->json(['status' => 200, 'message' => 'this user is logged in.']);
    });

    Route::prefix('/category')->group(function () {
        Route::post('/create', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('/anime')->group(function () {
        Route::post('/create', [VideoController::class, 'store']);

        Route::put('/{id}/rating', [VideoController::class, 'update_rating']);
        Route::put('/{id}/info', function (Request $request) {
            return response()->json(['status' => 200, 'message' => 'アニメ情報を更新しました']);
        });
        Route::delete('/{id}', [VideoController::class, 'destroy']);
    });
});

Route::prefix('anime')->group(function () {
    Route::get('/', function () {
        return response()->json([
            [
                'id' => 1,
                'animeName' => '秋桜丘高校舞台裏クラブ 〜星の輝き、未知の舞台へ〜これは、世界を舞台に繰り広げられる、知られざる高校生たちの物語。学園の舞台裏で奏でられる感動と謎の数々。本物の友情、夢、そして探求心。全てがここに綴られていく。',
                'category' => '学園',
                'rating' => '4.5',
                'synopsis' => '「セレスティア・アカデミア・アストラリス」という星降る学園、その名は世界中の人々によって称賛され、その輝きは夜空の星々に匹敵します。学園には、魔法、科学、芸術、文学、スポーツなど、多様な分野の才能ある生徒たちが集い、未知の可能性を求めて日夜努力しています。主人公、リュナ・スターブレイカーは、この学園に入学し、不思議な友情を築きます。ある日、星降りる夜に、彼女と仲間たちは不思議な冒険に出発します。彼らは、学園の秘密と星座の力を探求し、古代の魔法と明日への約束の物語に巻き込まれます。しかし、彼らの冒険は友情の奇跡と魔法の謎解きという試練の連続で、セレスティア学園が隠している秘密の闇が次第に明るみに出てきます。リュナと彼女の仲間たちは、運命と魔法の力で未来を切り拓く旅に出ます。',
                'keyVisual' => '/image/dummy.png',
                'keyVisualReference' => '© xyz制作より引用',
            ],
            [
                'id' => 2,
                'animeName' => '秋桜丘高校舞台裏クラブ 〜星の輝き、未知の舞台へ〜これは、世界を舞台に繰り広げられる、知られざる高校生たちの物語。学園の舞台裏で奏でられる感動と謎の数々。本物の友情、夢、そして探求心。全てがここに綴られていく。',
                'category' => '学園',
                'rating' => '4.5',
                'synopsis' => '「セレスティア・アカデミア・アストラリス」という星降る学園、その名は世界中の人々によって称賛され、その輝きは夜空の星々に匹敵します。学園には、魔法、科学、芸術、文学、スポーツなど、多様な分野の才能ある生徒たちが集い、未知の可能性を求めて日夜努力しています。主人公、リュナ・スターブレイカーは、この学園に入学し、不思議な友情を築きます。ある日、星降りる夜に、彼女と仲間たちは不思議な冒険に出発します。彼らは、学園の秘密と星座の力を探求し、古代の魔法と明日への約束の物語に巻き込まれます。しかし、彼らの冒険は友情の奇跡と魔法の謎解きという試練の連続で、セレスティア学園が隠している秘密の闇が次第に明るみに出てきます。リュナと彼女の仲間たちは、運命と魔法の力で未来を切り拓く旅に出ます。',
                'keyVisual' => '/image/dummy.png',
                'keyVisualReference' => '© xyz制作より引用',
            ],
            [
                'id' => 3,
                'animeName' => '3秋桜丘高校舞台裏クラブ 〜星の輝き、未知の舞台へ〜これは、世界を舞台に繰り広げられる、知られざる高校生たちの物語。学園の舞台裏で奏でられる感動と謎の数々。本物の友情、夢、そして探求心。全てがここに綴られていく。',
                'category' => '学園',
                'rating' => '4.5',
                'synopsis' => '「セレスティア・アカデミア・アストラリス」という星降る学園、その名は世界中の人々によって称賛され、その輝きは夜空の星々に匹敵します。学園には、魔法、科学、芸術、文学、スポーツなど、多様な分野の才能ある生徒たちが集い、未知の可能性を求めて日夜努力しています。主人公、リュナ・スターブレイカーは、この学園に入学し、不思議な友情を築きます。ある日、星降りる夜に、彼女と仲間たちは不思議な冒険に出発します。彼らは、学園の秘密と星座の力を探求し、古代の魔法と明日への約束の物語に巻き込まれます。しかし、彼らの冒険は友情の奇跡と魔法の謎解きという試練の連続で、セレスティア学園が隠している秘密の闇が次第に明るみに出てきます。リュナと彼女の仲間たちは、運命と魔法の力で未来を切り拓く旅に出ます。',
                'keyVisual' => '/image/dummy.png',
                'keyVisualReference' => '© xyz制作より引用',
            ],
        ]);
    });

    Route::get('/{id}', function () {
        return response()->json([
            // undefinedにしたくないのでデータがない時は空データで返す。プロパティは返すこと
            'id' => 1,
            'anime_name' => '秋桜丘高校舞台裏クラブ 〜星の輝き、未知の舞台へ〜これは、世界を舞台に繰り広げられる、知られざる高校生たちの物語。学園の舞台裏で奏でられる感動と謎の数々。本物の友情、夢、そして探求心。全てがここに綴られていく。',
            'broadcast_date' => '2023年　秋アニメ', // "year年. \S. seasonアニメ" をフォーマットする
            'categories' => [
                '学園',
                'SF',
            ],
            'comment' => '「秋桜丘高校舞台裏クラブ 〜星の輝き、未知の舞台へ〜」は、普段目にすることのない高校生たちの世界を描いた感動的な物語です。学園の裏側で展開される彼らの冒険と謎解きは魅力的で、友情、夢、探求心がテーマとして浮かび上がります。キャラクターたちの成長と絆は心温まり、視聴者に共感を呼び起こします。アニメの背後に隠れた輝きを追い求める彼らの物語は、心に残り、視聴者に感動と希望をもたらします。',
            'genre' => 20,
            'synopsis' => '「セレスティア・アカデミア・アストラリス」という星降る学園、その名は世界中の人々によって称賛され、その輝きは夜空の星々に匹敵します。学園には、魔法、科学、芸術、文学、スポーツなど、多様な分野の才能ある生徒たちが集い、未知の可能性を求めて日夜努力しています。主人公、リュナ・スターブレイカーは、この学園に入学し、不思議な友情を築きます。ある日、星降りる夜に、彼女と仲間たちは不思議な冒険に出発します。彼らは、学園の秘密と星座の力を探求し、古代の魔法と明日への約束の物語に巻き込まれます。しかし、彼らの冒険は友情の奇跡と魔法の謎解きという試練の連続で、セレスティア学園が隠している秘密の闇が次第に明るみに出てきます。リュナと彼女の仲間たちは、運命と魔法の力で未来を切り拓く旅に出ます。',
            'key_visual' => '/image/dummy.png',
            'key_visual_reference' => '© xyz制作より引用',
            'review_average' => '4',
            'review_story' => '4.0',
            'review_drawing' => '4.5',
            'review_voice_actor' => '3.0',
            'review_music' => '3.5',
            'review_characters' => '2.5',
            'watched_status' => 40
        ]);
    });
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
});
