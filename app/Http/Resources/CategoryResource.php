<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    // レスポンスのjson構造変更
    static public $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->isMethod('post')) {
            return [
                'status' => 200,
                'message' => 'カテゴリの登録が完了しました',
            ];
        } elseif ($request->isMethod('delete')) {
            return [
                'status' => 200,
                'message' => 'カテゴリを削除しました',
            ];
        } elseif ($request->isMethod('put')) {
            return [
                'status' => 200,
                'message' => 'カテゴリを更新しました',
            ];
        }
    }
}
