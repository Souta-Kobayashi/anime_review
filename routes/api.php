<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    Route::post('/anime/create', function (Request $request) {
        // // ファイルアップロードの処理
        // if ($request->hasFile('keyVisualImage')) {
        //     $file = $request->file('keyVisualImage');
        //     $filename = $file->getClientOriginalName();
        //     $path = $file->storeAs('images', $filename, 'public'); // ファイルの保存先を設定
        // }

        // // その他のデータを取得
        // $animeName = $request->input('animeName');
        // $broadcastDate = $request->input('broadcast_date');
        // $genre = $request->input('genre');
        // $synopsis = $request->input('synopsis');
        // $keyVisualReference = $request->input('keyVisualReference');

        // データベースへの保存などの処理

        // レスポンス
        return response()->json(['status' => 200, 'message' => 'アニメの登録が完了しました']);
    });

    Route::post('/category/create', function (Request $request) {
        // $categoryName = $request->input('categoryName');
        // データベースへの保存などの処理
        // レスポンス
        return response()->json(['status' => 200, 'message' => 'カテゴリの登録が完了しました']);
    });
});

// アニメ一覧を返却
Route::get('/anime', function () {
    return response()->json([
        [
            'id' => 1,
            'animeName' => '1秋桜丘高校舞台裏クラブ 〜星の輝き、未知の舞台へ〜これは、世界を舞台に繰り広げられる、知られざる高校生たちの物語。学園の舞台裏で奏でられる感動と謎の数々。本物の友情、夢、そして探求心。全てがここに綴られていく。',
            'category' => '学園',
            'rating' => '4.5',
            'synopsis' => '「セレスティア・アカデミア・アストラリス」という星降る学園、その名は世界中の人々によって称賛され、その輝きは夜空の星々に匹敵します。学園には、魔法、科学、芸術、文学、スポーツなど、多様な分野の才能ある生徒たちが集い、未知の可能性を求めて日夜努力しています。主人公、リュナ・スターブレイカーは、この学園に入学し、不思議な友情を築きます。ある日、星降りる夜に、彼女と仲間たちは不思議な冒険に出発します。彼らは、学園の秘密と星座の力を探求し、古代の魔法と明日への約束の物語に巻き込まれます。しかし、彼らの冒険は友情の奇跡と魔法の謎解きという試練の連続で、セレスティア学園が隠している秘密の闇が次第に明るみに出てきます。リュナと彼女の仲間たちは、運命と魔法の力で未来を切り拓く旅に出ます。',
            'keyVisual' => '/image/dummy.png',
            'keyVisualReference' => '© xyz制作より引用',
        ],
        [
            'id' => 2,
            'animeName' => '2秋桜丘高校舞台裏クラブ 〜星の輝き、未知の舞台へ〜これは、世界を舞台に繰り広げられる、知られざる高校生たちの物語。学園の舞台裏で奏でられる感動と謎の数々。本物の友情、夢、そして探求心。全てがここに綴られていく。',
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
