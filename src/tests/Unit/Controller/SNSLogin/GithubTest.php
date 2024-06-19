<?php

namespace Tests\Unit\Controller\SNSLogin;

use Tests\TestCase;
use Mockery;

use App\Http\Controllers\SNSLoginController;
use App\UseCases\SNSLoginUseCase;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class GithubTest extends TestCase
{
    const ID = '123';
    const NAME = 'test_name';
    const EMAIL = 'email@example.com';
    const PASSWORD = null;
    const PROVIDER = SNSProvider::GIT_HUB;
    const SNS_ID = 'test_sns_id';

    private $snsLoginController;
    private $snsLoginUseCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->snsLoginUseCase = Mockery::mock(SNSLoginUseCase::class);
        $this->snsLoginController = new SNSLoginController($this->snsLoginUseCase);
    }

    public function test_1_1(): void
    {
        $userEntity = new UserEntity(
            self::ID,
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
            self::PROVIDER,
            self::SNS_ID
        );
        $result = [
            'new' => false,
            'user' => $userEntity
        ];

        $this->snsLoginUseCase
        ->shouldReceive('gitHub')
        ->andReturn($result);

        $response = $this->snsLoginController->gitHub();

        $this->assertEquals(200, $response->getStatusCode());

        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(config('response.success.login'), $responseData['message']);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertEquals(self::ID, $responseData['data']['id']);
        $this->assertEquals(self::NAME, $responseData['data']['name']);
    }
    public function test_2_1(): void
    {
        $userEntity = new UserEntity(
            self::ID,
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
            self::PROVIDER,
            self::SNS_ID
        );
        $result = [
            'new' => true,
            'user' => $userEntity
        ];

        $this->snsLoginUseCase
        ->shouldReceive('gitHub')
        ->andReturn($result);

        $response = $this->snsLoginController->gitHub();

        $this->assertEquals(201, $response->getStatusCode());

        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(config('response.success.register'), $responseData['message']);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertEquals(self::ID, $responseData['data']['id']);
        $this->assertEquals(self::NAME, $responseData['data']['name']);
    }
}
