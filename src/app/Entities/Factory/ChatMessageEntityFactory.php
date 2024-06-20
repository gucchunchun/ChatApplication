<?php

namespace App\Entities\Factory;

use App\Entities\Factory\ChatRoomEntityFactory;
use App\Entities\Factory\UserEntityFactory;
use App\Models\ChatMessage;
use App\Entities\ChatMessageEntity;
use App\Entities\ChatRoomEntity;
use App\Entities\UserEntity;
use App\DTO\ChatMessageData;

class ChatMessageEntityFactory
{
  private $chatRoomEntityFactory;
  private $userEntityFactory;
  public function __construct(ChatRoomEntityFactory $chatRoomEntityFactory, UserEntityFactory $userEntityFactory)
  {
    $this->chatRoomEntityFactory = $chatRoomEntityFactory;;
    $this->userEntityFactory = $userEntityFactory;
  }

  /**
   * @param ChatMessage 
   * @param ChatRoomEntity 引数として提供されない場合、リレーションを使用してChatRoomモデル獲得する。
   * @param UserEntity 引数として提供されない場合、リレーションを使用してUserモデル獲得する。
   */
  public function createByModel(ChatMessage $chatMessage, ChatRoomEntity $chatRoomEntity = null, UserEntity $userEntity = null): ChatMessageEntity
  {
    return new ChatMessageEntity(
      $chatMessage->id,
      $chatRoomEntity?? $this->chatRoomEntityFactory->createByModel($chatMessage->chatRoom),
      $userEntity?? $this->userEntityFactory->createByModel($chatMessage->sender),
      $chatMessage->message,
      $chatMessage->created_at,
    );
  }
  public function createByData(ChatMessageData $chatMessageData): ChatMessageEntity
  {
    $chatRoomEntity = $this->chatRoomEntityFactory->createByData($chatMessageData->getChatRoomData());
    $sender = $this->userEntityFactory->createByData($chatMessageData->getUserData());

    return new ChatMessageEntity(
      $chatMessageData->getId(), 
      $chatRoomEntity,
      $sender,
      $chatMessageData->getMessage(),
      $chatMessageData->getCreatedAt()
    );
  }
}