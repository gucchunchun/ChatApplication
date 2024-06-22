<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\Factory;

use Database\Factories\ChatRoomFactory;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = 'chat_rooms';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'created_at',
    ];

    protected static function newFactory(): Factory
    {
        return ChatRoomFactory::new();
    }

    // Relations
    public function userChatRooms(): HasMany
    {
        return $this->hasMany(UserChatRoom::class, 'room_id', 'id');
    }
}
