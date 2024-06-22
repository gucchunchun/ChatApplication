<?php

namespace Tests\Feature\Repository\ChatMessage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Matching\ValidatorInterface;
use Tests\TestCase;

use App\Repositories\ChatMessage\ChatMessageRepository;
use App\Models\ChatMessage;

class FindByIdTest extends TestCase
{
    use RefreshDatabase;

    private $chatMessage;
    private $chatMessageRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->chatMessage = ChatMessage::factory()->create();
        $this->chatMessageRepository = new ChatMessageRepository(app(ChatMessage::class));
    }

    public function test_1_1(): void
    {
        $chatMessage = $this->chatMessageRepository->findById($this->chatMessage->id);

        $this->assertEquals($this->chatMessage->id, $chatMessage->id);
        $this->assertEquals($this->chatMessage->room_id, $chatMessage->room_id);
        $this->assertEquals($this->chatMessage->sender_id, $chatMessage->sender_id);
        $this->assertEquals($this->chatMessage->message, $chatMessage->message);
    }
    public function test_2_1(): void
    {
        $chatMessage = $this->chatMessageRepository->findById($this->chatMessage->id + 1);

        $this->assertEquals(null, $chatMessage);
    }
}
