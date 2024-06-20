<?php

namespace App\Services\Auth;

use App\Entities\UserEntity;
use App\Enum\SNSProvider;

interface AuthServiceInterface
{
    public function authenticate(array $credentials): UserEntity;
    public function authenticateWithSNS(SNSProvider $provider, string $snsId): UserEntity;
}
