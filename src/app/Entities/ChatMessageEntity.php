<?php

namespace App\Entities;

use App\Entities\ChatRoomEntity;
use App\Entities\UserEntity;

class ChatMessageEntity
{
    const ID_RULES = ['exist:chat_messages,id'];
    const ROOM_ID_RULES = ['exist:chat_rooms,id'];
    const SENDER_ID_RULES = ['exist:users,id'];
    const MESSAGE_RULES = ['max:1000'];

    private ?int $id;
    private ChatRoomEntity $room;
    private UserEntity $sender;
    private string $message;

    public function __construct(?int $id, ChatRoomEntity $room, UserEntity $sender, string $message)
    {
        $this->id = $id;
        $this->room = $room;
        $this->sender = $sender;
        $this->message = $message;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getRoom(): ChatRoomEntity
    {
        return $this->room;
    }
    public function getUser(): UserEntity
    {
        return $this->sender;
    }
    public function getMessage(): string
    {
        return $this->message;
    }
}
