<?php

namespace Tests\Unit\UseCase;

use PHPUnit\Framework\TestCase;
use Mockery;

use App\Services\User\CreateUser\CreateUserServiceInterface;
use App\Entities\Factory\UserEntityFactory;
use App\UseCases\RegisterUseCase;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class RegisterTest extends TestCase
{
    const ID = '123';
    const NAME = 'test_name';
    const EMAIL = 'email@example.com';
    const PASSWORD = 'test_password';
    const PROVIDER = SNSProvider::GIT_HUB;
    const SNS_ID = 'test_sns_id';

    private $registerUseCase;
    private $createUserService;
    private $userEntityFactory;

    protected function setUp(): void
    {
        $this->createUserService = Mockery::mock(CreateUserServiceInterface::class);
        $this->userEntityFactory = Mockery::mock(UserEntityFactory::class);
        
        $this->registerUseCase = new RegisterUseCase(
            $this->createUserService, 
            $this->userEntityFactory
        );
    }

    public function test_1_1(): void
    {
        $data = [
            'name' => self::NAME,
            'email' => self::EMAIL,
            'password' => self::PASSWORD
        ];
        $factoryUserEntity = new UserEntity(
            null,
            self::NAME,
            self::EMAIL,
            self::PASSWORD
        );
        $createdUserEntity = new UserEntity(
            self::ID,
            self::NAME,
            self::EMAIL,
            password_hash(self::PASSWORD, PASSWORD_DEFAULT)
        );

        $this->userEntityFactory
        ->shouldReceive('createByData')
        ->with($data)
        ->andReturn($factoryUserEntity);

        $this->createUserService
        ->shouldReceive('create')
        ->with($factoryUserEntity)
        ->andReturn($createdUserEntity);

        $return = $this->registerUseCase->execute($data);

        $this->assertEquals($createdUserEntity, $return);
    }
}
