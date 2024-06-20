<?php

namespace App\Services\ChatMessage\CreateChatMessage;

use App\Entities\Factory\ChatMessageEntityFactory;
use App\Repositories\ChatMessage\ChatMessageRepositoryInterface;
use App\Entities\ChatMessageEntity;

class CreateChatMessageService
{
    private  $chatMessageEntityFactory;
    private $chatMessageRepository;
    public function __construct(ChatMessageEntityFactory $chatMessageEntityFactory, ChatMessageRepositoryInterface $chatMessageRepository)
    {
        $this->chatMessageEntityFactory = $chatMessageEntityFactory;
        $this->chatMessageRepository = $chatMessageRepository;
    }

    public function create(ChatMessageEntity $chatMessageEntity): ChatMessageEntity
    {
        $chatMessage = $this->chatMessageRepository->save($chatMessageEntity);
            
        return $this->chatMessageEntityFactory->createByModel($chatMessage, $chatMessageEntity->getRoom(), $chatMessageEntity->getSender());
    }
}
