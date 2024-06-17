<?php

namespace App\Entities\ValueObject;

class ChannelName
{
    const REPLACEMENT = '{}';
    const TEMPLATE = 'chat_room_' . self::REPLACEMENT;
    private int $chatRoomId;

    public function __construct(int $chatRoomId = null)
    {
        $this->chatRoomId = $chatRoomId;
    }

    public function getName(): string
    {
       return str_replace(self::REPLACEMENT, $this->chatRoomId, self::TEMPLATE);
    }
}
