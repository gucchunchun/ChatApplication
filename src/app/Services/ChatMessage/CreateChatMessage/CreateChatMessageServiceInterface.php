<?php

namespace App\Services\ChatMessage\CreateChatMessage;

use App\Entities\ChatMessageEntity;

interface CreateChatMessageServiceInterface
{
    public function create(ChatMessageEntity $chatMessageEntity): ChatMessageEntity;
}
