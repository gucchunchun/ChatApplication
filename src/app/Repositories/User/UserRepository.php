<?php

namespace App\Repositories\User;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Repositories\Traits\Delete;
use App\Repositories\Traits\Update;
use App\Models\User;
use App\Entities\UserEntity;

class UserRepository implements UserRepositoryInterface
{
  use Delete, Update;
  private $modelClass;
  public function __construct(User $userModelClass)
    {
        $this->modelClass = $userModelClass;
  }
  public function findById(string|int $id): ?User
    {
      try
      {
        return $this->modelClass->find($id);
      }
      catch (\Exception $e)
      {
        throw new HttpException(500, $e->getMessage());
      }
  }
  public function findBySNS(string $provider, string $snsId): ?User
  {
    try
    {
      return $this->modelClass->where('provider', $provider)->where('sns_id', $snsId)->first();
    }
    catch (\Exception $e)
    {
      throw new HttpException(500, $e->getMessage());
    }
  }
  public function save(UserEntity $userEntity): User
  {
    try
    {
      return $this->modelClass->create([
        'name' => $userEntity->getName(),
        'email' => $userEntity->getEmail(),
        'password' => $userEntity->getPassword(),
        'provider' => $userEntity->getProvider(),
        'sns_id' => $userEntity->getsnsId(),
      ]);
    }
    catch (\Exception $e)
    {
      throw new HttpException(500, $e->getMessage());
    }
  }
}
