<?php

namespace App\Http\Requests\SendMessage;

use Illuminate\Foundation\Http\FormRequest;

use App\Entities\ChatRoomEntity;
use App\Entities\ChatMessageEntity;

class SendMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // UseCaseないでAuthorizationを行っている
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
            'roomId' => array_merge(['required'], ChatRoomEntity::ID_RULES),
            'message' => array_merge(['required'], ChatMessageEntity::MESSAGE_RULES),
        ];
    }
}
