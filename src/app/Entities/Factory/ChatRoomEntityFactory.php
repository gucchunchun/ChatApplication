<?php

namespace App\Entities\Factory;

use App\Models\ChatRoom;
use App\Entities\ChatRoomEntity;
use App\DTO\ChatRoomData;

class ChatRoomEntityFactory
{
  public function createByModel(ChatRoom $chatRoom): ChatRoomEntity
  {
    return new ChatRoomEntity(
      $chatRoom->id,
      $chatRoom->name,
    );
  }
  public function createByData(ChatRoomData $chatRoomData): ChatRoomEntity
  {
    return new ChatRoomEntity(
      $chatRoomData->getId(),
      $chatRoomData->getName(),
    );
  }
}