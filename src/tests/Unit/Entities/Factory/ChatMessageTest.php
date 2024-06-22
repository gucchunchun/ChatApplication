<?php

namespace Tests\Unit\Entities\Factory;

use PHPUnit\Framework\TestCase;
use Mockery;

use App\Entities\Factory\ChatMessageEntityFactory;
use App\Entities\Factory\ChatRoomEntityFactory;
use App\Entities\Factory\UserEntityFactory;
use App\Entities\ChatMessageEntity;
use App\Entities\ChatRoomEntity;
use App\Entities\UserEntity;
use App\DTO\ChatMessageData;
use App\DTO\ChatRoomData;
use App\DTO\UserData;
use App\Enum\SNSProvider;
use App\Models\ChatMessage;

class ChatMessageTest extends TestCase
{
    private $chatMessageEntityFactory;    
    private $chatRoomEntityFactory;
    private $userEntityFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->chatRoomEntityFactory = Mockery::mock(ChatRoomEntityFactory::class);
        $this->userEntityFactory = Mockery::mock(UserEntityFactory::class);

        $this->chatMessageEntityFactory = new ChatMessageEntityFactory($this->chatRoomEntityFactory, $this->userEntityFactory);
    }
}
