<?php

namespace App\UseCases;

use App\Services\GetAuthenticatedUserEntity\GetAuthenticatedUserEntityServiceInterface;

use App\Entities\UserEntity;
use App\Entities\ChatMessageEntity;

class SendMessageUseCase
{
    private $getAuthenticatedUserEntityService;

    public function __construct(GetAuthenticatedUserEntityServiceInterface $getAuthenticatedUserEntityService)
    {
        $this->getAuthenticatedUserEntityService = $getAuthenticatedUserEntityService;
    }

    public function send(int $roomId, string $message): ChatMessageEntity
    {
        $userEntity = $this->getAuthenticatedUserEntityService->get();
        return $userEntity->createMessage($roomId, $message);
    }
}
