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

        if ($request->isMethod('post')) {
            return [
                'status' => 200,
                'message' => 'アニメの登録が完了しました',
            ];
        } elseif ($request->isMethod('delete')) {
            return [
                'status' => 200,
                'message' => 'アニメを削除しました',
            ];
        } elseif (strpos($uri, 'rating') !== false) {
            return [
                'status' => 200,
                'message' => 'アニメのレビューが完了しました',
            ];
        }
    }
}
