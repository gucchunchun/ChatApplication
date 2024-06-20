<?php

namespace Tests\Unit\Repository\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

use App\Repositories\User\UserRepository;
use App\Models\User;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class UserSaveTest extends TestCase
{
    use RefreshDatabase;

    const ID = '123';
    const NAME = 'test_name';
    const EMAIL = 'email@example.com';
    const PASSWORD = 'test_password';
    const PROVIDER = SNSProvider::GIT_HUB;
    const SNS_ID = 'test_sns_id';

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
            self::NAME,
            self::EMAIL,
            self::PASSWORD,
        );

        $user = $this->userRepository->save($userEntity);

        $this->assertEquals($user->name, self::NAME);
        $this->assertEquals($user->email, self::EMAIL);
        $this->assertTrue(Hash::check(self::PASSWORD, $user->password));
        $this->assertEquals($user->provider, null);
        $this->assertEquals($user->sns_id, null);

        $this->assertDatabaseHas('users', [
            'name' => self::NAME,
            'email' => self::EMAIL,
            'provider' => null,
            'sns_id' => null,
        ]);
    }
    public function test_2_1(): void
    {
        $userEntity = new UserEntity(
            null,
            self::NAME,
            self::EMAIL,
            null,
            self::PROVIDER,
            self::SNS_ID
        );

        $user = $this->userRepository->save($userEntity);

        $this->assertEquals($user->name, self::NAME);
        $this->assertEquals($user->email, self::EMAIL);
        $this->assertEquals($user->password, null);
        $this->assertEquals($user->provider, self::PROVIDER);
        $this->assertEquals($user->sns_id, self::SNS_ID);

        $this->assertDatabaseHas('users', [
            'name' => self::NAME,
            'email' => self::EMAIL,
            'password' => null,
            'provider' => self::PROVIDER->value,
            'sns_id' => self::SNS_ID,
        ]);
    }
}
