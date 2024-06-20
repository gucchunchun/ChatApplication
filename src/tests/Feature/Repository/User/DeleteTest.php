<?php

namespace Tests\Feature\Repository\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\User\UserRepository;
use App\Models\User;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    private $userRepository;
    private $userPass;
    private $userGit;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->userRepository = new UserRepository(new User());
        $this->userPass = User::factory()->create();
        $this->userGit = User::factory()->create([
            'password' => null,
            'provider' => SNSProvider::GIT_HUB->value,
            'sns_id' => 'token'
        ]);
    }

    public function test_1_1(): void
    {
        $this->userRepository->delete($this->userPass->id);

        $this->assertSoftDeleted('users', [
            'id' => $this->userPass->id,
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->userGit->id,
        ]);
    }
    public function test_2_1(): void
    {
        $this->userRepository->delete($this->userGit->id);

        $this->assertSoftDeleted('users', [
            'id' => $this->userGit->id,
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->userPass->id,
        ]);
    }
    public function test_3_1(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->userRepository->delete(1);

        $this->assertDatabaseHas('users', [
            'id' => $this->userPass->id,
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->userGit->id,
        ]);

    }
}
