<?php

namespace Tests\Unit\Service;

use Tests\TestCase;
use Mockery;
use Illuminate\Support\Facades\Hash;

use App\Services\GetUserEntity\GetUserEntityService;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;
use App\Entities\UserEntity;
use App\Entities\Factory\UserEntityFactory;

class GetUserEntityTest extends TestCase
{
    const ID = '1';
    const NAME = 'test';
    const EMAIL = 'test@example.com';
    const PASSWORD = 'test_password';
    private $mockUserRepository;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->mockUserRepository = Mockery::mock(UserRepositoryInterface::class);
    }
    public function test_1_1(): void
    {
        $user = new User();
        $user->id  = self::ID;
        $user->name  = self::NAME;
        $user->email = self::EMAIL;
        $user->password = self::PASSWORD;

        $this->mockUserRepository
        ->shouldReceive('findById')
        ->with(self::ID)
        ->once()
        ->andReturn($user);

        $getUserEntityService = new GetUserEntityService(new UserEntityFactory, $this->mockUserRepository);

        $userEntity = $getUserEntityService->getById(self::ID);

        $this->assertInstanceOf(UserEntity::class, $userEntity);
        $this->assertEquals($userEntity->getId(), self::ID);
        $this->assertEquals($userEntity->getName(), self::NAME);
        $this->assertEquals($userEntity->getEmail(), self::EMAIL);
        $this->assertTrue(Hash::check(self::PASSWORD, $userEntity->getPassword()));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
