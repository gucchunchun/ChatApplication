<?php

namespace App\UseCases;

use App\Services\ChatRoomMembership\ChatRoomMembershipServiceInterface;
use App\Services\ChatMessage\CreateChatMessage\CreateChatMessageServiceInterface;
use App\Services\GetAuthenticatedUserEntity\GetAuthenticatedUserEntityServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use App\Entities\ChatMessageEntity;
use App\Events\MessageSent;

class SendMessageUseCase
{
    private $chatRoomMembershipService;
    private $createChatMessageService;
    private $getAuthenticatedUserEntityService;

    public function __construct(
        ChatRoomMembershipServiceInterface $chatRoomMembershipService,
        CreateChatMessageServiceInterface $createChatMessageService, 
        GetAuthenticatedUserEntityServiceInterface $getAuthenticatedUserEntityService
    )
    {
        $this->chatRoomMembershipService = $chatRoomMembershipService;
        $this->createChatMessageService = $createChatMessageService;
        $this->getAuthenticatedUserEntityService = $getAuthenticatedUserEntityService;
    }

    public function send(int $roomId, string $message): ChatMessageEntity
    {
        // ユーザーの特定
        $userEntity = $this->getAuthenticatedUserEntityService->get();

        // Roomにユーザーが登録されているか確認
        if(!$this->chatRoomMembershipService->isUserInChatRoom($userEntity->getId(), $roomId))
        {
            throw new AuthorizationException(config('response.error.send.unauthorized'));
        }

        // データ登録用のChatMessageEntityの作成
        $creatingChatMessageEntity = $userEntity->createMessage($roomId, $message);

        // DB登録
        $createdChatMessageEntity = $this->createChatMessageService->create($creatingChatMessageEntity);

        // イベント発火
        $chatRoomEntity = $createdChatMessageEntity->getRoom();
        MessageSent::dispatch(
            $chatRoomEntity->getChannelName(), 
            $chatRoomEntity->getName(),
            $createdChatMessageEntity->getSender()->getName(),
            $message
        );

        return $createdChatMessageEntity;
    }
}
