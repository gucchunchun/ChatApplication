<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\Factory;

use Database\Factories\ChatMessageFactory;

class ChatMessage extends Model
{
    use HasFactory;

    protected $table = 'chat_messages';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'room_id',
        'sender_id',
        'message',
        'created_at',
    ];

    protected static function newFactory(): Factory
    {
        return ChatMessageFactory::new();
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
