<?php

namespace Tests\Unit\Repository\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\User\UserRepository;
use App\Models\User;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class UserUpdateTest extends TestCase
{
    use RefreshDatabase;

    const ID = 'updated_id';
    const NAME = 'updated_name';
    const EMAIL = 'updated@example.com';
    const PASSWORD = 'updated_password';
    const PROVIDER = 'updated_provider';
    const SNS_TOKEN = 'updated_token';

    private $userRepository;
    private $userPass;
    private $userGit;
    private $userPassEntity;
    private $userGitEntity;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->userRepository = new UserRepository(new User());
        $this->userPass = User::factory()->create();
        $this->userGit = User::factory()->create([
            'password' => null,
            'provider' => SNSProvider::GIT_HUB->value,
            'sns_token' => 'token'
        ]);

        $this->userPassEntity = new UserEntity(
            $this->userPass->id,
            $this->userPass->name,
            $this->userPass->email,
            $this->userPass->password,
        );
        $this->userGitEntity = new UserEntity(
            $this->userGit->id,
            $this->userGit->name,
            $this->userGit->email,
            $this->userGit->password,
            $this->userGit->provider,
            $this->userGit->sns_token,
        );
    }

    public function test_1_1(): void
    { 
        $this->userPassEntity->update([
            'id' => self::ID
        ]);

        $this->userRepository->update($this->userPassEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userPass->id,
            'name' => $this->userPass->name,
            'email' => $this->userPass->email,
            'password' => $this->userPass->password,
            'provider' => $this->userPass->provider,
            'sns_token' => $this->userPass->sns_token,
        ]);
    }
    public function test_1_2(): void
    { 
        $this->userPassEntity->update([
            'name' => self::NAME
        ]);

        $this->userRepository->update($this->userPassEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userPass->id,
            'name' => self::NAME,
            'email' => $this->userPass->email,
            'password' => $this->userPass->password,
            'provider' => $this->userPass->provider,
            'sns_token' => $this->userPass->sns_token,
        ]);
    }
    public function test_1_3(): void
    { 
        $this->userPassEntity->update([
            'email' => self::EMAIL
        ]);

        $this->userRepository->update($this->userPassEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userPass->id,
            'name' => $this->userPass->name,
            'email' => $this->userPass->email,
            'password' => $this->userPass->password,
            'provider' => $this->userPass->provider,
            'sns_token' => $this->userPass->sns_token,
        ]);
    }
    public function test_1_4(): void
    { 
        $this->userPassEntity->update([
            'password' => self::PASSWORD
        ]);

        $this->userRepository->update($this->userPassEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userPass->id,
            'name' => $this->userPass->name,
            'email' => $this->userPass->email,
            'password' => $this->userPass->password,
            'provider' => $this->userPass->provider,
            'sns_token' => $this->userPass->sns_token,
        ]);
    }
    public function test_1_5(): void
    { 
        $this->userPassEntity->update([
            'provider' => self::PROVIDER
        ]);

        $this->userRepository->update($this->userPassEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userPass->id,
            'name' => $this->userPass->name,
            'email' => $this->userPass->email,
            'password' => $this->userPass->password,
            'provider' => $this->userPass->provider,
            'sns_token' => $this->userPass->sns_token,
        ]);
    }
    public function test_1_6(): void
    { 
        $this->userPassEntity->update([
            'snsToken' => self::SNS_TOKEN
        ]);

        $this->userRepository->update($this->userPassEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userPass->id,
            'name' => $this->userPass->name,
            'email' => $this->userPass->email,
            'password' => $this->userPass->password,
            'provider' => $this->userPass->provider,
            'sns_token' => self::SNS_TOKEN
        ]);
    }
    public function test_2_1(): void
    { 
        $this->userGitEntity->update([
            'id' => self::ID
        ]);

        $this->userRepository->update($this->userGitEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userGit->id,
            'name' => $this->userGit->name,
            'email' => $this->userGit->email,
            'password' => $this->userGit->password,
            'provider' => $this->userGit->provider,
            'sns_token' => $this->userGit->sns_token,
        ]);
    }
    public function test_2_2(): void
    { 
        $this->userGitEntity->update([
            'name' => self::NAME
        ]);

        $this->userRepository->update($this->userGitEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userGit->id,
            'name' => self::NAME,
            'email' => $this->userGit->email,
            'password' => $this->userGit->password,
            'provider' => $this->userGit->provider,
            'sns_token' => $this->userGit->sns_token,
        ]);
    }
    public function test_2_3(): void
    { 
        $this->userGitEntity->update([
            'email' => self::EMAIL
        ]);

        $this->userRepository->update($this->userGitEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userGit->id,
            'name' => $this->userGit->name,
            'email' => $this->userGit->email,
            'password' => $this->userGit->password,
            'provider' => $this->userGit->provider,
            'sns_token' => $this->userGit->sns_token,
        ]);
    }
    public function test_2_4(): void
    { 
        $this->userGitEntity->update([
            'password' => self::PASSWORD
        ]);

        $this->userRepository->update($this->userGitEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userGit->id,
            'name' => $this->userGit->name,
            'email' => $this->userGit->email,
            'password' => $this->userGit->password,
            'provider' => $this->userGit->provider,
            'sns_token' => $this->userGit->sns_token,
        ]);
    }
    public function test_2_5(): void
    { 
        $this->userGitEntity->update([
            'provider' => self::PROVIDER
        ]);

        $this->userRepository->update($this->userGitEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userGit->id,
            'name' => $this->userGit->name,
            'email' => $this->userGit->email,
            'password' => $this->userGit->password,
            'provider' => $this->userGit->provider,
            'sns_token' => $this->userGit->sns_token,
        ]);
    }
    public function test_2_6(): void
    { 
        $this->userGitEntity->update([
            'snsToken' => self::SNS_TOKEN
        ]);

        $this->userRepository->update($this->userGitEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userGit->id,
            'name' => $this->userGit->name,
            'email' => $this->userGit->email,
            'password' => $this->userGit->password,
            'provider' => $this->userGit->provider,
            'sns_token' => self::SNS_TOKEN
        ]);
    }
    public function test_3_1(): void
    { 
        $this->userGitEntity->update([
            'id' => self::ID,
            'name' => self::NAME,
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
            'provider' => self::PROVIDER,
            'snsToken' => self::SNS_TOKEN
        ]);

        $this->userRepository->update($this->userGitEntity);

        $this->assertDatabaseHas('users', [
            'id' => $this->userGit->id,
            'name' => self::NAME,
            'email' => $this->userGit->email,
            'password' => $this->userGit->password,
            'provider' => $this->userGit->provider,
            'sns_token' => self::SNS_TOKEN
        ]);
    }
    public function test_4_1(): void
    { 
        $this->expectException(ModelNotFoundException::class);

        $this->userRepository->update(new UserEntity('1', 'test', 'email', null));
    }
}
