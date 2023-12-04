<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Review;

class UpdateRatingRequest extends FormRequest
{
    private Rule $rule;

    public function __construct(Rule $rule)
    {
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
        $commonRule = $this->rule->in([0, 0.5, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0, 4.5, 5.0]);

        return [
            'review_story' => [$commonRule],
            'review_drawing' => [$commonRule],
            'review_voice_actor' => [$commonRule],
            'review_music' => [$commonRule],
            'review_characters' => [$commonRule],
        ];
    }

    public function attributes(): array
    {
        return [
            'review_story' => 'ストーリー',
            'review_drawing' => '作画',
            'review_voice_actor' => '声優',
            'review_music' => '音楽',
            'review_characters' => 'キャラクター',
        ];
    }

    public function make_rating(): Review
    {
        return new Review($this->validated());
    }
}
