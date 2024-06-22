<?php

namespace App\Repositories\ChatMessage;

use App\Repositories\ChatMessage\ChatMessageRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\ChatMessage;
use App\Entities\ChatMessageEntity;

class ChatMessageRepository implements ChatMessageRepositoryInterface
{
    private $modelClass;
    public function __construct(ChatMessage $chatMessageModelClass)
    {
        $this->modelClass = $chatMessageModelClass;
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
    public function findById(int $id): ?ChatMessage
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
    public function save(ChatMessageEntity $chatMessageEntity): ChatMessage
    {
      try
      {
        return $this->modelClass->create([
          'room_id' => $chatMessageEntity->getRoom()->getId(),
          'sender_id' => $chatMessageEntity->getSender()->getId(),
          'message' => $chatMessageEntity->getMessage()
        ]);
      }
      catch (\Exception $e)
      {
        throw new HttpException(500, $e->getMessage());
      }
    }
}
