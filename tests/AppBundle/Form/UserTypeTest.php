<?php

namespace Tests\AppBundle\Form;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
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

        $formData2 = [
            'username' => 'test',
            'password' => 'test',
            'email' => 'test@gmail.com'
        ];

        $form = $this->factory->create(UserType::class);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($form->getData(), $formData2);
    }

}