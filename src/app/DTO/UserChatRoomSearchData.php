<?php

namespace App\DTO;

class UserChatRoomSearchData
{
  private ?int $id;
  private ?string $userId;
  private ?int $roomId;
  public function __construct(int $id = null, string $userId = null, int $roomId = null) 
  {
    $this->id = $id;
    $this->userId = $userId;
    $this->roomId = $roomId;
  }

  public function getSearchData(): array 
  { 
    $data = [];

    foreach (get_object_vars($this) as $key => $value)
    {
      if (is_null($value)) continue;

      $data[$key] = $value;
    }

    return $data;
  }
}
