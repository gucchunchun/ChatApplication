<?php

namespace Tests\Feature\Repository\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

use App\Repositories\User\UserRepository;
use App\Models\User;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class FindByIdTest extends TestCase
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
        $user = $this->userRepository->findById($this->userPass->id);

        $this->assertEquals($this->userPass->id, $user->id);
        $this->assertEquals($this->userPass->email, $user->email);
        $this->assertEquals($user->password, $this->userPass->password);
    }
    public function test_2_1(): void
    {
        $user = $this->userRepository->findById($this->userGit->id);

        $this->assertEquals($this->userGit->id, $user->id);
        $this->assertEquals($this->userGit->email, $user->email);
        $this->assertEquals(null, $user->password);
        $this->assertEquals($this->userGit->provider, $user->provider);
        $this->assertEquals($this->userGit->sns_id, $user->sns_id);
    }
    public function test_3_1(): void
    {
        $user = $this->userRepository->findById(1);

        $this->assertEquals(null, $user);
    }
}
