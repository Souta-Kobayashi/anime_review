<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $uri = $request->path();
        $status = 200;
        $message = '';

        if ($request->isMethod('post')) {
            $message = 'アニメの登録が完了しました';
        } elseif ($request->isMethod('delete')) {
            $message = 'アニメを削除しました';
        } elseif (strpos($uri, 'rating') !== false) {
            $message = 'アニメのレビューが完了しました';
        } elseif (strpos($uri, 'info') !== false) {
            $message = 'アニメ情報を更新しました';
        }

        return [
            'status' => $status,
            'message' => $message,
        ];
    }
}
