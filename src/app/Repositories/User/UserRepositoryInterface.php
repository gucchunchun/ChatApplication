<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Entities\UserEntity;

interface UserRepositoryInterface
{
  public function delete(string $id): void;
  public function findById(string $id): ?User;
  public function findBySNS(string $provider, string $snsId): ?User;
  public function save(UserEntity $userEntity): User;
  public function update(UserEntity $userEntity): void;
}