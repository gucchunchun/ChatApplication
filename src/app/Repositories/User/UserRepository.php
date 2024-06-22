<?php

namespace App\Repositories\User;

use App\Repositories\User\UserRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Traits\Update;
use App\Models\User;
use App\Entities\UserEntity;

class UserRepository implements UserRepositoryInterface
{
  use Update;
  private $modelClass;
  public function __construct(User $userModelClass)
  {
        $this->modelClass = $userModelClass;
  }
  public function delete(string $id): void
  {
    try
    {
      $model = $this->modelClass->findOrFail($id);
      $model->delete();
    }
    catch (ModelNotFoundException $e)
    {
      throw new ModelNotFoundException($e->getMessage());
    }
    catch (\Exception $e)
    {
      logger($e->getMessage());
      throw new HttpException(500, $e->getMessage());
    }
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
        'sns_id' => $userEntity->getSNSId(),
      ]);
    }
    catch (\Exception $e)
    {
      throw new HttpException(500, $e->getMessage());
    }
  }
}
