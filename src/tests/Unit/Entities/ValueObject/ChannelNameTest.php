<?php

namespace Tests\Unit\Entities\ValueObject;

use PHPUnit\Framework\TestCase;
use TypeError;

use App\Entities\ValueObject\ChannelName;

class ChannelNameTest extends TestCase
{
    const TEMPLATE = 'chat_room_';
    const ROOM_ID_int = 1;
    const ROOM_ID_string = 'string';
    public function test_1_1(): void
    {
        $channelName = new ChannelName(self::ROOM_ID_int);

        $name = $channelName->getName();

        $this->assertEquals(self::TEMPLATE . self::ROOM_ID_int, $name);
    }
    public function test_1_2(): void
    {
        $this->expectException(TypeError::class);

        new ChannelName(self::ROOM_ID_string);
    }
}
