<?php

namespace App\Entities;

use App\Entities\ValueObject\ChannelName;

class ChatRoomEntity
{
    const ID_RULES = ['exist:chat_rooms,id'];
    const NAME_RULES = ['min:1', 'max:24'];
    const UPDATABLES = [
        'name'
    ];

    private ?int $id;
    private string $name;
    private ChannelName $channelName;

    public function __construct(?int $id, ?string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->channelName = new ChannelName($id);
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getChannelName(): ChannelName
    {
        return $this->channelName;
    }
    public function update(array $data): void
    {
        foreach (self::UPDATABLES as $updatable)
        {
            if (isset($data[$updatable])) {
                $this->$updatable = $data[$updatable];
            }
        }
    }
}
