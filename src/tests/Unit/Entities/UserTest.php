<?php

namespace Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;

use App\Entities\UserEntity;

class UserEntityTest extends TestCase
{
    const ID_1 = '1';    
    const ID_3 = 1;   
    const NAME_1 = 'test_user';
    const NAME_3 = 'updated_user';
    const EMAIL_1 = 'test@example.com';
    const EMAIL_3 = 'updated@example.com';
    const PASS_1 = 'test_password';
    const PASS_3 = 'updated_password';
    const PATTERN_2 = null;    

    private $userEntity;
    protected function setUp(): void
    {
        $this->userEntity = new UserEntity(
            self::ID_1,
            self::NAME_1,
            self::EMAIL_1,
            self::PASS_1
        );
    }
    public function test_1_1(): void
    {
        $id = $this->userEntity->getId();

        $this->assertEquals(self::ID_1, $id);
    }
    public function test_1_2(): void
    {
        $userEntity = new UserEntity(
            self::PATTERN_2,
            self::NAME_1,
            self::EMAIL_1,
            self::PASS_1
        );

        $id = $userEntity->getId();

        $this->assertEquals(self::PATTERN_2, $id);
    }
    public function test_2_1(): void
    {
        $name = $this->userEntity->getName();

        $this->assertEquals(self::NAME_1, $name);
    }
    public function test_3_1(): void
    {
        $email = $this->userEntity->getEmail();

        $this->assertEquals(self::EMAIL_1, $email);
    }
    public function test_4_1(): void
    {
        $pass = $this->userEntity->getPassword();

        $this->assertEquals(self::PASS_1, $pass);
    }
    public function test_4_2(): void
    {
        $userEntity = new UserEntity(
            self::ID_1,
            self::NAME_1,
            self::EMAIL_1,
            self::PATTERN_2
        );

        $pass = $userEntity->getPassword();
        $this->assertEquals(self::PATTERN_2, $pass);
    }
    public function test_5_1(): void
    {
        $updates = ['name' => self::NAME_3];

        $this->userEntity->update($updates);

        $id = $this->userEntity->getId();
        $name = $this->userEntity->getName();
        $email = $this->userEntity->getEmail();
        $pass = $this->userEntity->getPassword();
        $this->assertEquals(self::ID_1, $id);
        $this->assertEquals(self::NAME_3, $name);
        $this->assertEquals(self::EMAIL_1, $email);
        $this->assertEquals(self::PASS_1, $pass);
    }
    public function test_5_2(): void
    {
        $updates = ['id' => self::ID_3];

        $this->userEntity->update($updates);

        $id = $this->userEntity->getId();
        $name = $this->userEntity->getName();
        $email = $this->userEntity->getEmail();
        $pass = $this->userEntity->getPassword();
        $this->assertEquals(self::ID_1, $id);
        $this->assertEquals(self::NAME_1, $name);
        $this->assertEquals(self::EMAIL_1, $email);
        $this->assertEquals(self::PASS_1, $pass);
    }
    public function test_5_3(): void
    {
        $updates = ['email' => self::EMAIL_3];

        $this->userEntity->update($updates);

        $id = $this->userEntity->getId();
        $name = $this->userEntity->getName();
        $email = $this->userEntity->getEmail();
        $pass = $this->userEntity->getPassword();
        $this->assertEquals(self::ID_1, $id);
        $this->assertEquals(self::NAME_1, $name);
        $this->assertEquals(self::EMAIL_1, $email);
        $this->assertEquals(self::PASS_1, $pass);
    }
    public function test_5_4(): void
    {
        $updates = ['pass' => self::PASS_3];

        $this->userEntity->update($updates);

        $id = $this->userEntity->getId();
        $name = $this->userEntity->getName();
        $email = $this->userEntity->getEmail();
        $pass = $this->userEntity->getPassword();
        $this->assertEquals(self::ID_1, $id);
        $this->assertEquals(self::NAME_1, $name);
        $this->assertEquals(self::EMAIL_1, $email);
        $this->assertEquals(self::PASS_1, $pass);
    }
    public function test_5_5(): void
    {
        $updates = ['id' => self::ID_3, 'name' => self::NAME_3];

        $this->userEntity->update($updates);

        $id = $this->userEntity->getId();
        $name = $this->userEntity->getName();
        $email = $this->userEntity->getEmail();
        $pass = $this->userEntity->getPassword();
        $this->assertEquals(self::ID_1, $id);
        $this->assertEquals(self::NAME_3, $name);
        $this->assertEquals(self::EMAIL_1, $email);
        $this->assertEquals(self::PASS_1, $pass);
    }
    public function test_5_6(): void
    {
        $updates = ['email' => self::EMAIL_3, 'name' => self::NAME_3];

        $this->userEntity->update($updates);

        $id = $this->userEntity->getId();
        $name = $this->userEntity->getName();
        $email = $this->userEntity->getEmail();
        $pass = $this->userEntity->getPassword();
        $this->assertEquals(self::ID_1, $id);
        $this->assertEquals(self::NAME_3, $name);
        $this->assertEquals(self::EMAIL_1, $email);
        $this->assertEquals(self::PASS_1, $pass);
    }
    public function test_5_7(): void
    {
        $updates = ['pass' => self::PASS_3, 'name' => self::NAME_3];

        $this->userEntity->update($updates);

        $id = $this->userEntity->getId();
        $name = $this->userEntity->getName();
        $email = $this->userEntity->getEmail();
        $pass = $this->userEntity->getPassword();
        $this->assertEquals(self::ID_1, $id);
        $this->assertEquals(self::NAME_3, $name);
        $this->assertEquals(self::EMAIL_1, $email);
        $this->assertEquals(self::PASS_1, $pass);
    }
}
