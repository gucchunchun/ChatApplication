<?php

namespace App\Repositories\Traits;

use App\Entities\UpdatableEntityInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Utilities\StringConverter;

trait Update
{
  public function update(UpdatableEntityInterface $entity): void
  {
    // TODO: この時点で1: ユーザーが存在すること, 2: 更新内容（バリデーション、実際に更新する部分があるか）はチェック済みにする
    try
    {
      $model = $this->modelClass->findOrFail($entity->getId());

      foreach ($entity->getUpdatableFields() as $field)
      {
        $method = 'get' . ucfirst($field);
        if (method_exists($entity, $method)) {
          $columName = StringConverter::camelToSnake($field);
          $model->$columName = call_user_func([$entity, $method]);
        }
      }
      $model->save();
    }
    catch (ModelNotFoundException $e)
    {
      throw new ModelNotFoundException($e->getMessage());
    }
    catch (\Exception $e)
    {
      throw new HttpException(500, $e->getMessage());
    }
  }
}