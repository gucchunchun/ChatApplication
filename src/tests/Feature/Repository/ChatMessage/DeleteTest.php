<?php

namespace Tests\Feature\Repository\ChatMessage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Repositories\ChatMessage\ChatMessageRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ChatMessage;

class DeleteTest extends TestCase
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
        $this->chatMessageRepository->delete($this->chatMessage->id);

        $this->assertDatabaseMissing('chat_messages', [
            'id' => $this->chatMessage->id
        ]);
    }
    public function test_2_1(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->chatMessageRepository->delete($this->chatMessage->id + 1);

        $this->assertDatabaseHas('chat_messages', [
            'id' => $this->chatMessage->id
        ]);
    }
}
