<?php


namespace App\Tests\Entity;


use App\Entity\Task;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGet()
    {
        $user = new User();

        $this->assertNull($user->getId());

        $user->setUsername('test');

        $this->assertSame('test', $user->getUsername());

        $user->setPassword('test');

        $this->assertSame('test', $user->getPassword());

        $user->setEmail('test@gmail.com');

        $user->setPlainPassword('test');
        $task = new Task();

        $this->assertSame('test', $user->getPlainPassword());

        $user->eraseCredentials();
        $this->assertNull($user->getPlainPassword());

        $this->assertInstanceOf(User::class, $user->addTask($task));

        $this->assertInstanceOf(Collection::class, $user->getTasks());
        $this->assertContainsOnlyInstancesOf(Task::class, $user->getTasks());

        $this->assertInstanceOf(User::class, $user->removeTask($task));

        $this->assertEmpty($user->getTasks());

        $this->assertSame('test@gmail.com', $user->getEmail());
        $this->assertSame(null, $user->getSalt());
        $this->assertSame(['ROLE_USER'], $user->getRoles());

        $this->assertNull($user->setRoles(array('ROLE_ADMIN')));

    }

}