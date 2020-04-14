<?php


namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGet()
    {
        $user = new User();

        $user->setUsername('test');

        $this->assertSame('test', $user->getUsername());

        $user->setPassword('test');

        $this->assertSame('test', $user->getPassword());

        $user->setEmail('test@gmail.com');

        $this->assertSame('test@gmail.com', $user->getEmail());
        $this->assertSame(null, $user->getSalt());
        $this->assertSame(['ROLE_USER'], $user->getRoles());
    }

}