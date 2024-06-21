<?php

namespace App\Services\ChatMessage\CreateChatMessage;

use App\Services\ChatMessage\CreateChatMessage\CreateChatMessageServiceInterface;
use App\Entities\Factory\ChatMessageEntityFactory;
use App\Repositories\ChatMessage\ChatMessageRepositoryInterface;
use App\Entities\ChatMessageEntity;

class CreateChatMessageService implements CreateChatMessageServiceInterface
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
            
        // User情報は揃っているが、ChatRoomに関してはIDのみでルーム名がわからないためnullにしてFactoryないでリレーションからデータゲットを行う
        return $this->chatMessageEntityFactory->createByModel($chatMessage, null, $chatMessageEntity->getSender());
    }
}
