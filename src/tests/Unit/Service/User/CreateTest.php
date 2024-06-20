<?php

namespace Tests\Unit\Service\User;

use Tests\TestCase;
use Mockery;

use App\Services\User\CreateUser\CreateUserService;
use App\Entities\Factory\UserEntityFactory;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;


class CreateTest extends TestCase
{
    const ID = '123';
    const NAME = 'test_name';
    const EMAIL = 'email@example.com';
    const PASSWORD = 'test_password';
    const PROVIDER = SNSProvider::GIT_HUB;
    const SNS_ID = 'test_sns_id';

    private $createUserService;
    private $userEntityFactory;
    private $userRepository;

    protected function setUp():void
    {
        parent::setUp();

        $this->userEntityFactory = Mockery::mock(UserEntityFactory::class);
        $this->userRepository = Mockery::mock(UserRepositoryInterface::class);
        $this->createUserService = new CreateUserService(
            $this->userEntityFactory,
            $this->userRepository
        );
    }
    public function test_1_1(): void
    {
        $inputUserEntity = new UserEntity(
            null,
            self::NAME,
            self::EMAIL,
            self::PASSWORD
        );
        $createdUser = new User();
        $createdUser->fill([
            'id' => self::ID,
            'name' => self::NAME,
            'email' => self::EMAIL,
            'password' => self::PASSWORD
        ]);

        $createdUserEntity = new UserEntity(
            self::ID,
            self::NAME,
            self::EMAIL,
            password_hash(self::PASSWORD, PASSWORD_DEFAULT)
        );

        $this->userRepository
        ->shouldReceive('save')
        ->with($inputUserEntity)
        ->andReturn($createdUser);

        $this->userEntityFactory
        ->shouldReceive('createByModel')
        ->with($createdUser)
        ->andReturn($createdUserEntity);

        $return = $this->createUserService->create($inputUserEntity);

        $this->assertEquals($createdUserEntity, $return);
    }
}
