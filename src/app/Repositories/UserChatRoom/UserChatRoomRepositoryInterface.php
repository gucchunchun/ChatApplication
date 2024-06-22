<?php

namespace App\Repositories\UserChatRoom;

use App\Models\UserChatRoom;
use App\DTO\UserChatRoomSearchData;

interface UserChatRoomRepositoryInterface
{
    public function delete(int $id): void;
    public function exists(UserChatRoomSearchData $searchData): bool;
    public function save(string $userId, int $roomId): UserChatRoom;
}
