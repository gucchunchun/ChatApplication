<?php

namespace Tests\Unit\UseCase;

use PHPUnit\Framework\TestCase;
use Mockery;

use App\UseCases\SNSLoginUseCase;
use App\Services\Auth\AuthServiceInterface;
use App\Services\User\CreateUser\CreateUserServiceInterface;
use App\Services\SNSConnect\SNSConnectServiceInterface;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\MissingNameException;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;


class SNSLoginTest extends TestCase
{
    const ID = '123';
    const NAME = 'test';
    const EMAIL = 'test@example.com';
    const PASSWORD = null;
    const PROVIDER = SNSProvider::GIT_HUB;
    const SNS_ID = 'test_sns_id';

    private $snsLoginUseCase;
    private $authService;
    private $createUserService;
    private $snsConnectService;

    public function setUp(): void
    {
        parent::setUp();

        $this->authService = Mockery::mock(AuthServiceInterface::class);
        $this->createUserService = Mockery::mock(CreateUserServiceInterface::class);
        $this->snsConnectService = Mockery::mock(SNSConnectServiceInterface::class);

        $this->snsLoginUseCase = new SNSLoginUseCase(
            $this->authService,
            $this->createUserService,
            $this->snsConnectService
        );

    }

    public function test_1_1(): void
    {
        $tempUserEntity = new UserEntity(
            null,
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
            self::PROVIDER,
            self::SNS_ID
        );
        $userEntity = new UserEntity(
            self::ID,
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
            self::PROVIDER,
            self::SNS_ID
        );

        $this->snsConnectService
        ->shouldReceive('handleSNSCallback')
        ->with(SNSProvider::GIT_HUB)
        ->andReturn($tempUserEntity);

        $this->authService
        ->shouldReceive('authenticateWithSNS')
        ->with(SNSProvider::GIT_HUB, self::SNS_ID)
        ->andReturn($userEntity);

        $return = $this->snsLoginUseCase->github();

        $this->assertEquals($userEntity, $return['user']);
        $this->assertFalse($return['new']);
    }
    public function test_2_1(): void
    {
        $tempUserEntity = new UserEntity(
            null,
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
            self::PROVIDER,
            self::SNS_ID
        );
        $userEntity = new UserEntity(
            self::ID,
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
            self::PROVIDER,
            self::SNS_ID
        );

        $this->snsConnectService
        ->shouldReceive('handleSNSCallback')
        ->with(SNSProvider::GIT_HUB)
        ->andReturn($tempUserEntity);

        $this->authService
        ->shouldReceive('authenticateWithSNS')
        ->with(SNSProvider::GIT_HUB, self::SNS_ID)
        ->andThrow(new AuthenticationException());

        $this->createUserService
        ->shouldReceive('create')
        ->with($tempUserEntity)
        ->andReturn($userEntity);

        $return = $this->snsLoginUseCase->github();

        $this->assertEquals($userEntity, $return['user']);
        $this->assertTrue($return['new']);
    }
    public function test_3_1(): void
    {
        $tempUserEntity = new UserEntity(
            null,
            null,
            self::EMAIL,
            self::PASSWORD,
            self::PROVIDER,
            self::SNS_ID
        );

        $this->snsConnectService
        ->shouldReceive('handleSNSCallback')
        ->with(SNSProvider::GIT_HUB)
        ->andReturn($tempUserEntity);

        $this->authService
        ->shouldReceive('authenticateWithSNS')
        ->with(SNSProvider::GIT_HUB, self::SNS_ID)
        ->andThrow(new AuthenticationException());

        $this->expectException(MissingNameException::class);

        $return = $this->snsLoginUseCase->github();

        dd($return);
    }
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
