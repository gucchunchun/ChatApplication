<?php

namespace App\Entities;

use App\Entities\EntityInterface;
use App\Entities\ChatRoomEntity;
use App\Entities\UserEntity;

class ChatMessageEntity implements EntityInterface
{
    const ID_RULES = ['exists:chat_messages,id'];
    const ROOM_ID_RULES = ['exists:chat_rooms,id'];
    const SENDER_ID_RULES = ['exists:users,id'];
    const MESSAGE_RULES = ['max:1000'];

    private ?int $id;
    private ChatRoomEntity $room;
    private UserEntity $sender;
    private string $message;
    private ?string $createdAt;

    public function __construct(?int $id, ChatRoomEntity $room, UserEntity $sender, string $message, string $createdAt = null)
    {
        $this->id = $id;
        $this->room = $room;
        $this->sender = $sender;
        $this->message = $message;
        $this->createdAt = $createdAt? $this->formatDate($createdAt): $createdAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getRoom(): ChatRoomEntity
    {
        return $this->room;
    }
    public function getSender(): UserEntity
    {
        return $this->sender;
    }
    public function getMessage(): string
    {
        return $this->message;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    private function formatDate(string $datetime): string 
    {
        return (new \DateTime($datetime))->format('Y-m-d H:i:s');
    }
}
