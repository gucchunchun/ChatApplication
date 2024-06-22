<?php

namespace App\Services\ChatRoomMembership;

interface ChatRoomMembershipServiceInterface
{
    public function isUserInChatRoom(string $userId, string $roomId): bool;
}
