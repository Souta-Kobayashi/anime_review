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
    return response()->json(['status' => 200, 'message' => 'test']);
});
