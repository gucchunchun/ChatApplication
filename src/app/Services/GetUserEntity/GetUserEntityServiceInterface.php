<?php

namespace App\Services\GetUserEntity;

use App\Entities\UserEntity;
use App\Enum\SNSProvider;

interface GetUserEntityServiceInterface
{
    public function getById(string $userId): ?UserEntity;
    public function getBySNS(SNSProvider $provider, string $snsId): ?UserEntity;
}
