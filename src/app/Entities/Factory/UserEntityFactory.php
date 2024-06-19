<?php

namespace App\Entities\Factory;

use App\Models\User;
use App\Entities\UserEntity;

class UserEntityFactory
{
  public function createByModel(User $user)
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
  public function createByData(array $userData)
  {
    return new UserEntity(
      $userData['id']?? null,
      $userData['name']?? null,
      $userData['email'],
      $userData['password']??null,
      $userData['provider']??null,
      $userData['snsId']??null
    );
  }
}