<?php

namespace App\Repositories\UserChatRoom;

use App\Repositories\UserChatRoom\UserChatRoomRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\UserChatRoom;
use App\DTO\UserChatRoomSearchData;
use App\Utilities\StringConverter;

class UserChatRoomRepository implements UserChatRoomRepositoryInterface
{
  private $modelClass;
  public function __construct(UserChatRoom $userChatRoomModelClass)
  {
    $this->modelClass = $userChatRoomModelClass;
  }
  public function delete(int $id): void
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
  public function exists(UserChatRoomSearchData $searchData): bool
  {
    try
    {
      $query = $this->modelClass->newQuery();

      foreach ($searchData->getSearchData() as $searchDataKey => $searchDataValue)
      {
        $query->where(StringConverter::camelToSnake($searchDataKey), $searchDataValue);
      }
  
      return $query->exists();
    }
    catch (\Exception $e)
    {
      throw new HttpException(500, $e->getMessage());
    }
  }
  public function save(string $userId, int $roomId): UserChatRoom
  {
    try
    {
      return $this->modelClass->create([
        'user_id' => $userId,
        'room_id' => $roomId,
      ]);
    }
    catch (\Exception $e)
    {
      throw new HttpException(500, $e->getMessage());
    }
  }
}
