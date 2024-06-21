<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\Factory;

use Database\Factories\UserChatRoomFactory;

class UserChatRoom extends Model
{
    use HasFactory;

    protected $table = 'user_chat_room';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'room_id',
        'created_at',
    ];

    protected static function newFactory(): Factory
    {
        return UserChatRoomFactory::new();
    }

    // Relations
    public function chatRoom(): BelongsTo
    {
        return $this->belongsTo(ChatRoom::class, 'room_id', 'id');
    }
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
