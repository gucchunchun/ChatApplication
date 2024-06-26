<?php

namespace Tests\Unit\Entities\Factory;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Mockery;

use App\Entities\Factory\UserEntityFactory;
use App\Models\User;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;
use App\DTO\UserData;

class UserEntityTest extends TestCase
{ 
    const ID = '123';
    const NAME = 'test_user';
    const EMAIL = 'test@example.com';
    const PASSWORD = 'test_password';
    const PROVIDER = SNSProvider::GIT_HUB;
    const SNS_ID = 'test_sns_id';
    private $userEntityFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->userEntityFactory = new UserEntityFactory();
    }

    public function test_1_1(): void
    {
        $user = Mockery::mock(User::class);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('id')
        ->andReturn(self::ID);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('name')
        ->andReturn(self::NAME);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('email')
        ->andReturn(self::EMAIL);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('password')
        ->andReturn(Hash::make(self::PASSWORD));
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('provider')
        ->andReturn(null);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('sns_id')
        ->andReturn(null);

        $userEntity = $this->userEntityFactory->createByModel($user);

        $this->assertEquals(self::ID, $userEntity->getId());
        $this->assertEquals(self::NAME, $userEntity->getName());
        $this->assertEquals(self::EMAIL, $userEntity->getEmail());
        $this->assertTrue(Hash::check(self::PASSWORD, $userEntity->getPassword()));
        $this->assertEquals(null, $userEntity->getProvider());
        $this->assertEquals(null, $userEntity->getSNSId());
    }
    public function test_1_2(): void
    {
        $user = Mockery::mock(User::class);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('id')
        ->andReturn(self::ID);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('name')
        ->andReturn(self::NAME);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('email')
        ->andReturn(self::EMAIL);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('password')
        ->andReturn(null);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('provider')
        ->andReturn(self::PROVIDER);
        $user
        ->shouldReceive('__get')
        ->shouldReceive('getAttribute')
        ->once()
        ->with('sns_id')
        ->andReturn(self::SNS_ID);

        $userEntity = $this->userEntityFactory->createByModel($user);

        $this->assertEquals(self::ID, $userEntity->getId());
        $this->assertEquals(self::NAME, $userEntity->getName());
        $this->assertEquals(self::EMAIL, $userEntity->getEmail());
        $this->assertEquals(null, $userEntity->getPassword());
        $this->assertEquals(self::PROVIDER->value, $userEntity->getProvider());
        $this->assertEquals(self::SNS_ID, $userEntity->getSNSId());
    }
    public function test_2_1(): void
    {
        $userData = new UserData(
            null, 
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
            null,
            null
        );

        $userEntity = $this->userEntityFactory->createByData($userData);

        $this->assertEquals(null, $userEntity->getId());
        $this->assertEquals(self::NAME, $userEntity->getName());
        $this->assertEquals(self::EMAIL, $userEntity->getEmail());
        $this->assertEquals(self::PASSWORD, $userEntity->getPassword());
        $this->assertEquals(null, $userEntity->getProvider());
        $this->assertEquals(null, $userEntity->getSNSId());
    }
    public function test_2_2(): void
    {
        $userData = new UserData(
            null, 
            self::NAME,
            self::EMAIL,
            null,
            self::PROVIDER,
            self::SNS_ID,
        );

        $userEntity = $this->userEntityFactory->createByData($userData);

        $this->assertEquals(null, $userEntity->getId());
        $this->assertEquals(self::NAME, $userEntity->getName());
        $this->assertEquals(self::EMAIL, $userEntity->getEmail());
        $this->assertEquals(null, $userEntity->getPassword());
        $this->assertEquals(self::PROVIDER->value, $userEntity->getProvider());
        $this->assertEquals(self::SNS_ID, $userEntity->getSNSId());
    }
    public function test_2_3(): void
    {
        $userData = new UserData(
            null, 
            self::NAME,
            self::EMAIL,
            null,
            self::PROVIDER,
            self::SNS_ID,
        );

        $userEntity = $this->userEntityFactory->createByData($userData);

        $this->assertEquals(null, $userEntity->getId());
        $this->assertEquals(null, $userEntity->getName());
        $this->assertEquals(self::EMAIL, $userEntity->getEmail());
        $this->assertEquals(null, $userEntity->getPassword());
        $this->assertEquals(self::PROVIDER->value, $userEntity->getProvider());
        $this->assertEquals(self::SNS_ID, $userEntity->getSNSId());
    }
}
