<?php

namespace Tests\Feature\Route;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\Fluent\AssertableJson;

use App\Models\User;
use App\Models\ChatRoom;
use App\Models\UserChatRoom;
use App\Events\MessageSent;

class SendMessageTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $chatRoomUserSubscribe;
    private $chatRoomUserNotSubscribe;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->chatRoomUserSubscribe = ChatRoom::factory()->create();
        $this->chatRoomUserNotSubscribe = ChatRoom::factory()->create();

        UserChatRoom::factory()->create([
            'user_id' => $this->user->id,
            'room_id' => $this->chatRoomUserSubscribe->id
        ]);

        Event::fake([
            MessageSent::class
        ]);
    }

    public function test_1_1(): void
    {
        $response = $this->post(
            'api/message/send', 
            [], 
            [
                'Accept' => 'application/json'
            ]
        );

        $response->assertStatus(401);
    }
    public function test_2_1(): void
    {
        $response = $this->actingAs($this->user)
        ->post(
            'api/message/send', 
            [], 
            [
                'Accept' => 'application/json'
            ]
        );  

        $response->assertStatus(422);
    }
    public function test_3_1(): void
    {
        $message = 'test_message';
        $response = $this->actingAs($this->user)
        ->post(
            'api/message/send', 
            [
                'roomId' => $this->chatRoomUserSubscribe->id,
                'message' => $message
            ], 
            [
                'Accept' => 'application/json'
            ]
        );  

        $response
        ->assertStatus(201)
        ->assertJson(fn(AssertableJson $json) => 
            $json
            ->where('message', config('response.success.send.message'))
            ->has('data', fn(AssertableJson $data) => 
                $data
                ->has('id')
                ->where('roomId', $this->chatRoomUserSubscribe->id)
                ->where('roomName', $this->chatRoomUserSubscribe->name)
                ->where('message', $message)
            )
        );

        $this->assertDatabaseHas('chat_messages', [
            'room_id' => $this->chatRoomUserSubscribe->id,
            'sender_id' => $this->user->id,
            'message' => $message
        ]);

        Event::assertDispatched(MessageSent::class, function ($event) use ($message) {
            return $event->roomName === $this->chatRoomUserSubscribe->name &&
                   $event->senderName === $this->user->name &&
                   $event->message === $message;
        });
    }
    public function test_4_1(): void
    {
        $message = 'test_message';

        $response = $this->actingAs($this->user)
        ->post(
            'api/message/send', 
            [
                'roomId' => $this->chatRoomUserNotSubscribe->id,
                'message' => $message
            ], 
            [
                'Accept' => 'application/json'
            ]
        );  

        $response->assertStatus(403);
    }
}
