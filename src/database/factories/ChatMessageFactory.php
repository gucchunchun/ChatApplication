<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ChatRoom;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatMessage>
 */
class ChatMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $room = ChatRoom::factory()->create();
        $user = User::factory()->create();
        return [
            'room_id' => $room->id,
            'sender_id' => $user->id,
            'message' => fake()->text()
        ];
    }
}
