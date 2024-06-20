<?php

namespace Tests\Unit\UseCase;

use PHPUnit\Framework\TestCase;
use Mockery;

use App\UseCases\LoginUseCase;
use App\Services\Auth\AuthServiceInterface;
use App\Entities\UserEntity;
use Illuminate\Auth\AuthenticationException;

class LoginTest extends TestCase
{
    const ID = '123';
    const NAME = 'test_name';
    const EMAIL = 'email@example.com';
    const PASSWORD = 'test_password';

    private $loginUseCase;
    private $authService;
    private $userEntity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authService = Mockery::mock(AuthServiceInterface::class);
        $this->loginUseCase = new LoginUseCase($this->authService);
        $this->userEntity = new UserEntity(
            self::ID,
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
        );
    }

    public function test_1_1(): void
    {
        $credentials = [
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
        ];
        $this->authService
        ->shouldReceive('authenticate')
        ->with($credentials)
        ->andReturn($this->userEntity);

        $result = $this->loginUseCase->execute($credentials);

        $this->assertEquals($result, $this->userEntity);
    }
    public function test_2_1(): void
    {
        $credentials = [
            'id' => self::ID,
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
        ];
        $filteredCredentials = [
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
        ];


        $this->authService
        ->shouldReceive('authenticate')
        ->with($filteredCredentials)
        ->andReturn($this->userEntity);

        $result = $this->loginUseCase->execute($credentials);

        $this->assertEquals($result, $this->userEntity);
    }
    public function test_2_2(): void
    {
        $credentials = [
            'name' => self::NAME,
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
        ];
        $filteredCredentials = [
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
        ];


        $this->authService
        ->shouldReceive('authenticate')
        ->with($filteredCredentials)
        ->andReturn($this->userEntity);

        $result = $this->loginUseCase->execute($credentials);

        $this->assertEquals($result, $this->userEntity);
    }
    public function test_3_1(): void
    {
        $credentials = [
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
        ];
        $this->authService
        ->shouldReceive('authenticate')
        ->with($credentials)
        ->andThrow(new AuthenticationException());

        $this->expectException(AuthenticationException::class);
        $this->loginUseCase->execute($credentials);
    }
}
