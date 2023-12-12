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

        // post, put, destroyアクションのメッセージ返却
        if ($this->is_message_return_resource($request, $uri)) {
            return $this->make_message_resource($request, $uri);
        }

        // アニメ一覧
        if ($this->is_video_index_resource($request, $uri)) {
            return $this->make_video_index_resource($request, $uri);
        }
    }

    public function is_message_return_resource($request, $uri): bool
    {
        return $request->isMethod('post')
            || $request->isMethod('delete')
            || strpos($uri, 'rating') !== false
            || strpos($uri, 'info') !== false;
    }

    public function is_video_index_resource($request, $uri): bool
    {
        return $request->isMethod('get')
            || preg_match('/anime\/?$/', $uri) !== false;
    }

    /**
     * post, put, destroyアクションのメッセージ返却
     *
     * @param  Request  $request リクエストクラス
     * @param  string  $uri リクエストしたパス
     */
    public function make_message_resource(Request $request, $uri): array
    {
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

    /**
     * /api/anime/のリソースを返却
     */
    public function make_video_index_resource(): array
    {
        return [
            'id' => $this->resource['id'] ?? '',
            'animeName' => $this->resource['anime_name'] ?? '',
            'categories' => $this->resource['category'] ?? [], // array
            'rating' => $this->resource['rating'] ?? '',
            'synopsis' => $this->resource['synopsis'] ?? '',
            'keyVisual' => $this->resource['key_visual'] ?? '',
            'keyVisualReference' => $this->resource['key_visual_reference'] ?? '',
        ];
    }
}
