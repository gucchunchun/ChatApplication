<?php

namespace App\Services\SNSConnect;

use App\Enum\SNSProvider;
use App\Entities\UserEntity;

interface SNSConnectServiceInterface
{
    public function getRedirectUrl(SNSProvider $provider): string;    
    public function handleSNSCallback(SNSProvider $provider): UserEntity;
}
