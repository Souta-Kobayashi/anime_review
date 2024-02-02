<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrUpdateRequest extends FormRequest
{
    private Rule $rule;

    private Category $category;

    public function __construct(
        Rule $rule,
        Category $category,
    ) {
        $this->rule = $rule;
        $this->category = $category;
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
                'max:100',
                $this->rule->unique($this->category->getTable()),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'カテゴリ',
        ];
    }

    public function make_category(): Category
    {
        return new Category($this->validated());
    }
}
