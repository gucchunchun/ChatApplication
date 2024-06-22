<?php

namespace Tests\Feature\Repository\ChatMessage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Repositories\ChatMessage\ChatMessageRepository;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\User;
use App\Entities\ChatMessageEntity;
use App\Entities\ChatRoomEntity;
use App\Entities\UserEntity;

class SaveTest extends TestCase
{
    use RefreshDatabase;

    const MESSAGE = 'test_message';
    private $chatMessageRepository;
    private $chatRoom;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->chatRoom = ChatRoom::factory()->create();
        $this->user = User::factory()->create();

        $this->chatMessageRepository = new ChatMessageRepository(app(ChatMessage::class));
    }

    public function test_1_1(): void
    {
        $roomEntity = new ChatRoomEntity(
            $this->chatRoom->id,
            $this->chatRoom->name
        );
        $userEntity = new UserEntity(
            $this->user->id,
            $this->user->name,
            $this->user->email,
            $this->user->password
        );
        $inputChatMessageEntity = new ChatMessageEntity(
            null,
            $roomEntity,
            $userEntity ,
            self::MESSAGE
        );

        $chatMessage = $this->chatMessageRepository->save($inputChatMessageEntity);

        $this->assertEquals($this->chatRoom->id, $chatMessage->room_id);
        $this->assertEquals($this->user->id, $chatMessage->sender_id);
        $this->assertEquals(self::MESSAGE, $chatMessage->message);

        $this->assertDatabaseHas('chat_messages', [
            'room_id' => $this->chatRoom->id,
            'sender_id' => $this->user->id,
            'message' => self::MESSAGE,
        ]);
    }
}
