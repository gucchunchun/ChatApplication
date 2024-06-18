<?php

namespace Tests\Unit\Repository\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\User\UserRepository;
use App\Models\User;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class UserSaveTest extends TestCase
{
    use RefreshDatabase;

    private $userRepository;
    private $user;
    private $userGit;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->userRepository = new UserRepository(new User());
        $this->user = User::factory()->create();
    }

    public function test_1_1(): void
    {
        $userEntity = new UserEntity(
            null,
            'test_save_name',
            'test_save@axample.com',
            'test_save_password',
        );

        $this->userRepository->save($userEntity);

        $this->assertDatabaseHas('users', [
            'name' => $userEntity->getName(),
            'email' => $userEntity->getEmail(),
            'provider' => $userEntity->getProvider(),
            'sns_token' => $userEntity->getSnsToken(),
        ]);
    }
}
