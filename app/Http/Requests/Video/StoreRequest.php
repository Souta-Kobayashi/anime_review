<?php

namespace App\Http\Requests\Video;

use App\Models\Video;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    private Rule $rule;

    private Video $video;

    public function __construct(
        Rule $rule,
        Video $video,
    ) {
        $this->rule = $rule;
        $this->video = $video;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:400',
                $this->rule->unique($this->video->getTable()),
            ],
            'broadcast_date' => 'max:100',
            'genre' => [
                'nullable',
                $this->rule->in([10, 20]),
            ],
            'synopsis' => 'max:10000',
            'key_visual_image' => [
                'nullable',
                'image',
            ],
            'key_visual_reference' => 'max:450',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'アニメ名',
            'broadcast_date' => '放送時期',
            'genre' => 'ジャンル',
            'synopsis' => 'あらすじ',
            'key_visual_image' => 'キービジュアル画像',
            'key_visual_reference' => 'キービジュアル参照元',
        ];
    }

    public function make_video(array $data): Video
    {
        // broadcast_dataのフォーマット修正
        $data = format_broadcast_date_for_database($data);

        // 画像をディスクに保存しkey_visual_urlに変換する
        if (! empty($data['key_visual_image'])) {
            $image = $data['key_visual_image'];
            $key_visual_url = time().'.'.$image->getClientOriginalExtension();
            // 画像をディスクに保存
            $image->storeAs('uploads', $key_visual_url, 'public');
            $data['key_visual_url'] = $key_visual_url;
        }
        // DBにはパスだけ保存するため$dataから削除
        unset($data['key_visual_image']);

        return new Video($data);
    }
}
