<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

use App\Entities\UserEntity;

class LoginRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => array_unshift(UserEntity::EMAIL_RULES, 'required'),
            'password' => array_unshift(UserEntity::PASSWORD_RULES, 'required')
        ];
    }
}
