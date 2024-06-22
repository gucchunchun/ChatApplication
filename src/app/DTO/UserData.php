<?php

namespace App\DTO;

use App\Enum\SNSProvider;

class UserData
{
  private ?string $id;
  private string $name;
  private string $email;
  private ?string $password;
  private ?SNSProvider $provider;
  private ?string $snsId;
  public function __construct(
    ?string $id, string $name, string $email, ?string $password, 
    ?SNSProvider $provider, ?string $snsId
  ) 
  {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->provider = $provider;
    $this->snsId = $snsId;
  }

  public function getId(): ?string { return $this->id; }
  public function getName(): string { return $this->name; }
  public function getEmail(): string { return $this->email; }
  public function getPassword(): ?string { return $this->password; }
  public function getProvider(): ?SNSProvider { return $this->provider; }
  public function getSNSId(): ?string { return $this->snsId; }
}
