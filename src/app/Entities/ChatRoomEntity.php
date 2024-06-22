<?php

namespace App\Entities;

use App\Entities\UpdatableEntityInterface;
use App\Entities\ValueObject\ChannelName;

class ChatRoomEntity implements UpdatableEntityInterface
{
    const ID_RULES = ['exists:chat_rooms,id'];
    const NAME_RULES = ['min:1', 'max:24'];
    const UPDATABLES = [
        'name'
    ];

    private ?int $id;
    private ?string $name;
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
    public function getChannelName(): string
    {
        return $this->channelName->getName();
    }
    public function getUpdatableFields(): array
    {
        return self::UPDATABLES;
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
