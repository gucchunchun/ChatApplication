<?php

namespace App\Services\SNSAuth;

use Illuminate\Http\RedirectResponse;
use App\Enum\SNSProvider;
use App\Entities\UserEntity;

interface SNSConnectServiceInterface
{
    public function handleSNSCallback(SNSProvider $provider): UserEntity;
    public function redirectToSNS(SNSProvider $provider): RedirectResponse;
}
