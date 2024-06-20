<?php

namespace App\Repositories\ChatMessage;

use App\Models\ChatMessage;
use App\Entities\ChatMessageEntity;

interface ChatMessageRepositoryInterface
{
    public function delete(int $id): void;
    public function findById(int $id): ?ChatMessage;
    public function save(ChatMessageEntity $chatMessageEntity): ChatMessage;
}
