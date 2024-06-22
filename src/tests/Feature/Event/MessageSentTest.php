<?php

namespace Tests\Feature\Event;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use App\Events\MessageSent;
use Pusher\Pusher;

class MessageSentTest extends TestCase
{
    public function test_1(): void
    {
        Event::fake();

        // Dispatch the event
        MessageSent::dispatch('channel1', 'room_name', 'sender_name', 'hello world!');

        // Assert that the event was dispatched
        Event::assertDispatched(MessageSent::class, function ($event) {
            return $event->channelName === 'channel1' &&
                   $event->roomName === 'room_name' &&
                   $event->senderName === 'sender_name' &&
                   $event->message === 'hello world!';
        });
    }
}
