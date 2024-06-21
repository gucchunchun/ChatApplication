<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\UseCases\SendMessageUseCase;
use App\Http\Requests\SendMessage\SendMessageRequest;
use App\Http\Resources\ChatMessage\SentChatMessageResource;

class SendMessageController extends Controller
{
    private $sendMessageUseCase;
    public function __construct(SendMessageUseCase $sendMessageUseCase)
    {
        $this->sendMessageUseCase = $sendMessageUseCase;
    }

    public function __invoke(SendMessageRequest $request): JsonResponse
    {
        $chatMessageEntity = $this->sendMessageUseCase->send($request->roomId, $request->message);

        return $this->createResponse(
            config('response.success.send.message'), 
            (new SentChatMessageResource($chatMessageEntity))->resolve(),
            201
        );
    }
}
