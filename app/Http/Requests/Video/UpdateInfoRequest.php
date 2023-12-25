<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInfoRequest extends FormRequest
{
    private Rule $rule;

    public function __construct(
        Rule $rule,
    ) {
        $this->rule = $rule;
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
        $common_rule = 'nullable';

        return [
            'categories' => [$common_rule],
            'watched_status' => [$common_rule, $this->rule->in([10, 20, 30, 40])],
            'broadcast_date' => [$common_rule, 'max:100'],
            'genre' => [$common_rule, $this->rule->in([10, 20])],
            'synopsis' => [$common_rule, 'max:10000'],
            'comment' => [$common_rule, 'max:15000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'categories' => 'カテゴリ',
            'watched_status' => '視聴状況',
            'broadcast_date' => '放送時期',
            'genre' => 'ジャンル',
            'synopsis' => 'あらすじ',
            'comment' => 'コメント',
        ];
    }

    public function make_anime_info(array $data): array
    {
        // broadcast_dataのフォーマット修正
        $data = format_broadcast_date_for_database($data);

        return $data;
    }
}
