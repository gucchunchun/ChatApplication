<?php

namespace Tests\Unit\Controller\Login;

use Tests\TestCase;
use Mockery;
use Illuminate\Testing\Fluent\AssertableJson;

use App\Http\Controllers\LoginController;
use App\UseCases\LoginUseCase;
use App\Http\Requests\Login\LoginRequest;
use App\Entities\UserEntity;

class LoginTest extends TestCase
{
    const ID = '123';
    const NAME = 'test_name';
    const EMAIL = 'email@example.com';
    const PASSWORD = 'test_password';

    private $loginController;
    private $loginRequest;
    private $loginUseCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loginUseCase = Mockery::mock(LoginUseCase::class);
        $this->loginRequest = Mockery::mock(LoginRequest::class);
        $this->loginController = new LoginController($this->loginUseCase);
    }

    public function test_1_1(): void
    {   
        $credentials = [
            'email' => self::EMAIL,
            'password' => self::PASSWORD
        ];

        $userEntity = new UserEntity(
            self::ID,
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
        );

        $this->loginRequest
        ->shouldReceive('validated')
        ->andReturn($credentials);

        $this->loginUseCase
        ->shouldReceive('execute')
        ->with($credentials)
        ->andReturn($userEntity);

        $response = $this->loginController->__invoke($this->loginRequest);


        $this->assertEquals(200, $response->getStatusCode());

        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(config('response.success.login'), $responseData['message']);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertEquals(self::ID, $responseData['data']['id']);
        $this->assertEquals(self::NAME, $responseData['data']['name']);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

}
