<?php

use Illuminate\Support\Facades\Broadcast;
use App\Entities\ValueObject\ChannelName;
use App\Models\UserChatRoom;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel(ChannelName::TEMPLATE . '{chatRoomId}', function ($user, $chatRoomId) {
    return UserChatRoom::where('user_id', $user->id)->where('room_id', $chatRoomId)->exists();
});
