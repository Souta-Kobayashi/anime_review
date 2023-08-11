<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Actions\Fortify\PasswordValidationRules;

class CreateUserRequest extends FormRequest
{
    use PasswordValidationRules;
    private $rule;
    private $user;

    public function __construct(Rule $rule,
                                User $user)
    {
        $this->rule = $rule;
        $this->user = $user;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => $this->emailValidationRules(),
            'password' => $this->passwordRules(),
        ];
    }

    private function emailValidationRules(): array
    {
        return [
            'required',
            'string',
            'email',
            'max:255',
            $this->rule->unique($this->user->getTable()),
        ];
    }
}
