<?php

namespace App\Entities;

use App\Entities\UpdatableEntityInterface;
use App\Entities\ChatRoomEntity;
use App\Entities\ChatMessageEntity;
use App\Enum\SNSProvider;

class UserEntity implements UpdatableEntityInterface
{
    // Requestバリデーション内で使用するビジネスロジックに関わる値
    const ID_RULES = ['exist:users,id'];
    const NAME_RULES = ['min:8', 'max:24'];
    const EMAIL_RULES = ['email:strict'];
    const PASSWORD_RULES = ['min:10', 'max:32'];
    const UPDATABLES = [
        'name', 'snsToken'
    ];

    private ?string $id;
    private string $name;
    private string $email;
    private ?string $password;
    private ?string $provider;
    private ?string $snsToken;

    public function __construct(
        ?string $id, string $name, string $email, ?string $password, ?SNSProvider $provider = null, ?string $snsToken = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->provider = $provider?$provider->value: $provider;
        $this->snsToken = $snsToken;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function getProvider(): ?string
    {
        return $this->provider;
    }
    public function getSnsToken(): ?string
    {
        return $this->snsToken;
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
    public function createMessage(int $room_id, string $message): ChatMessageEntity
    {
        return new ChatMessageEntity(
            null, new ChatRoomEntity($room_id, null), $this, $message);
    }
}
