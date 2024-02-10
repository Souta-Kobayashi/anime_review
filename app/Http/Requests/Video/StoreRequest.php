<?php

namespace App\Http\Requests\Video;

use App\Models\Video;
use App\Rules\ImageExtensionRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

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
                $this->rule
                    ->unique($this->video->getTable())
                    // ソフトデリートされていないレコードが対象
                    ->where(fn (Builder $query) => $query->whereNull('deleted_at')),
            ],
            'broadcast_date' => 'max:100',
            'genre' => [
                'nullable',
                $this->rule->in([10, 20]),
            ],
            'synopsis' => 'max:10000',
            'key_visual_image' => [
                'nullable',
                new ImageExtensionRule,
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

            // 画像データをbase64でエンコード svgファイルはエンコードできなかったので直データをbase64エンコードしている
            if ($image->extension() !== 'svg') {
                // w1:h1.4
                $resized_image = Image::make($image->getRealPath())->resize(600, 840);
                $data['key_visual_url'] = 'data:image/webp;base64,'.base64_encode($resized_image->encode('webp'));
            } else {
                $data['key_visual_url'] = 'data:image/svg+xml;base64,'.base64_encode(file_get_contents($image->getRealPath()));
            }
        }
        // DBにはパスだけ保存するため$dataから削除
        unset($data['key_visual_image']);

        return new Video($data);
    }
}
