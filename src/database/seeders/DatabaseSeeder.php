<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\ChatRoom;
use App\Models\UserChatRoom;
use App\Models\ChatMessage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userId = User::factory()->create([
            'email' => env('TEST_USER_EMAIL'),
            'password' => 'test_password',
        ]);

        ChatRoom::factory()->create([
            'name' => 'test_chat_room',
        ]);

        UserChatRoom::factory()->create([
            'user_id' => $userId,
            'room_id' => 1
        ]);

        ChatMessage::factory()->create([
            'room_id' => 1,
            'sender_id' => $userId,
            'message' => 'test_message'
        ]);
    }
}
