<?php

namespace App\Entities\Factory;

use App\Models\User;
use App\Entities\UserEntity;
use App\DTO\UserData;

class UserEntityFactory
{
  public function createByModel(User $user): UserEntity
  {
    return new UserEntity(
      $user->id,
      $user->name,
      $user->email,
      $user->password,
      $user->provider,
      $user->sns_id
    );
  }
  public function createByData(UserData $userData): UserEntity
  {
    return new UserEntity(
      $userData->getId(),
      $userData->getName(),
      $userData->getEmail(),
      $userData->getPassword(),
      $userData->getProvider(),
      $userData->getSNSId(),
    );
  }
}