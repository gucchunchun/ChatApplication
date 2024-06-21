<?php

namespace App\Http\Resources\ChatMessage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SentChatMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $roomEntity = $this->getRoom();
        return [
            'id' => $this->getId(),
            'roomId' =>  $roomEntity->getId(),
            'roomName' => $roomEntity->getName(),
            'message' => $this->getMessage()
        ];
    }
}
