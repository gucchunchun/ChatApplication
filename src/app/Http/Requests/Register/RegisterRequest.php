<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;

use App\Entities\UserEntity;

class RegisterRequest extends FormRequest
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
            'name' => array_merge('required', UserEntity::NAME_RULES),
            'email' => array_merge('required', UserEntity::EMAIL_RULES),
            'password' => array_merge(['required'], UserEntity::PASSWORD_RULES, ['confirmed'])
        ];
    }
}
