<?php

namespace App\Entities\ValueObject;

class ChannelName
{
    const TEMPLATE = 'chat_room_';
    private int $chatRoomId;

    public function __construct(int $chatRoomId = null)
    {
        $this->chatRoomId = $chatRoomId;
    }

    public function getName(): string
    {
        return self::TEMPLATE . $this->chatRoomId;
    }
}
