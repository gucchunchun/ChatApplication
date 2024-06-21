<?php

namespace App\Repositories\UserChatRoom;

use App\Models\UserChatRoom;

interface UserChatRoomRepositoryInterface
{
    public function delete(int $id): void;
    public function save(string $userId, int $roomId): UserChatRoom;
}
