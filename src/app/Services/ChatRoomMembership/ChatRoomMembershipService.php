<?php

namespace App\Services\ChatRoomMembership;

use App\Repositories\UserChatRoom\UserChatRoomRepositoryInterface;
use App\DTO\UserChatRoomSearchData;

class ChatRoomMembershipService
{
    private $userChatRoomRepository;
    public function __construct(UserChatRoomRepositoryInterface $userChatRoomRepository)
    {
        $this->userChatRoomRepository = $userChatRoomRepository;
    }

    public function isUserInChatRoom(string $userId, string $roomId): bool
    {
        $searchData = new UserChatRoomSearchData(null, $userId, $roomId);
        return $this->userChatRoomRepository->exists($searchData);
    }
}
