<?php

namespace App\DTO;

use App\Enum\SNSProvider;
use App\DTO\ChatRoomData;
use App\DTO\UserData;

class ChatMessageData
{
  private ?int $id;
  private ChatRoomData $chatRoomData;
  private UserData $userData;
  private string $message;
  private string $createdAt;
  public function __construct(
    int $id, int $roomId, string $roomName, string $senderId, string $senderName, 
    string $senderEmail, ?string $senderPassword, ?SNSProvider $senderProvider, 
    ?string $senderSNSId, string $message, string $createdAt
  ) 
  {
    $this->id = $id;
    $this->chatRoomData = new ChatRoomData($roomId, $roomName);
    $this->userData = new UserData($senderId, $senderName, $senderEmail, $senderPassword, $senderProvider, $senderSNSId);
    $this->message = $message;
    $this->createdAt = $createdAt;
  }

  public function getId(): int { return $this->id; }
  public function getChatRoomData(): ChatRoomData { return $this->chatRoomData; }
  public function getUserData(): UserData { return $this->userData; }
  public function getMessage(): string { return $this->message; }
  public function getCreatedAt(): string { return $this->createdAt; }
}
