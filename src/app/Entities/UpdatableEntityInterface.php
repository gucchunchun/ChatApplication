<?php

namespace App\Entities;

use App\Entities\EntityInterface;

interface UpdatableEntityInterface extends EntityInterface
{
  public function getUpdatableFields(): array;
}