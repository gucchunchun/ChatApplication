<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ChatRoom;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserChatRoom>
 */
class UserChatRoomFactory extends Factory
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
            'user_id' => $user->id,
            'room_id' => $room->id,
        ];
    }
}
