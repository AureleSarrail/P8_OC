<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @covers \AppBundle\Controller\DefaultController::indexAction
     */
    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testIndexActionAuth()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);

        $client->request('GET', '/');

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }
}
