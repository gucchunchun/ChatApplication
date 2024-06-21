<?php

namespace App\Http\Controllers;

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

    public function send(SendMessageRequest $request)
    {
        $chatMessageEntity = $this->sendMessageUseCase->send($request->roomId, $request->message);

        $this->createResponse(
            config('response.success.send.message'), 
            (new SentChatMessageResource($chatMessageEntity))->resolve(),
            201
        );
    }
}
