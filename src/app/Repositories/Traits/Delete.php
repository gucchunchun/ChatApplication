<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait Delete
{
  public function delete(string|int $id): void
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
}