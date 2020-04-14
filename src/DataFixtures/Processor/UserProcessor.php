<?php

namespace App\DataFixtures\Processor;

use Fidry\AliceDataFixtures\ProcessorInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserProcessor implements ProcessorInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordEncoderInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @inheritdoc
     */
    public function preProcess(string $fixtureId, $object): void
    {
        if (!$object instanceof User) {
            return;
        }

        $object->setPassword($this->passwordHasher->encodePassword($object, $object->getPlainPassword()));
    }

    /**
     * @inheritdoc
     */
    public function postProcess(string $fixtureId, $object): void
    {
        // do nothing
    }
}