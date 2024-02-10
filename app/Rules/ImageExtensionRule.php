<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Concerns\ValidatesAttributes;

/**
 * CustomImageValidationRule
 *
 * Illuminate\Validation\Concerns\ValidatesAttributesトレイトの
 * validateImage()を拡張するためのカスタムバリデーション
 * よってこのカスタムバリデーションは、ValidatesAttributesトレイトに依存している
 */
class ImageExtensionRule implements ValidationRule
{
    use ValidatesAttributes;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->validateMimes($attribute, $value, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp', 'heic'])) {
            $fail('選択した画像の拡張子は使用できません');
        }
    }
}
