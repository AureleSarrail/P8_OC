<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\Test\TypeTestCase;

class UserTypeTest extends TypeTestCase
{
    public function testUserType()
    {
        $formData = [
            'username' => 'test',
            'password' => array('first' => 'test', 'second' => 'test'),
            'email' => 'test@gmail.com'
        ];

        $userToCompare = new User();

        $form = $this->factory->create(UserType::class, $userToCompare);

        $user = new User();
        $user->setUsername('test');
        $user->setPassword('test');
        $user->setEmail('test@gmail.com');

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($user->getUsername(), $userToCompare->getUsername());
    }

}