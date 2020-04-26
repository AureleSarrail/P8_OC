<?php


namespace App\Tests\Repository;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testUserRepo()
    {
        $repo = $this->entityManager->getRepository(User::class);

        $this->assertInstanceOf(UserRepository::class, $repo);
    }
}