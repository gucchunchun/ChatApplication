<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = 'chat_rooms';
    protected $primaryKey = 'id';
    protected $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'created_at',
    ];

    // Relations
    public function userChatRooms(): HasMany
    {
        return $this->hasMany(UserChatRoom::class, 'room_id', 'id');
    }
}
