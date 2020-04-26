<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function providerUrls()
    {
        return [
            ['/users'],
            ['/users/create'],
            ['/users/1/edit']
        ];
    }

    /**
     * @dataProvider providerUrls
     * @param $url
     */
    public function testUrls($url)
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $client->request('GET', $url);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @covers \App\Controller\UserController::createAction
     */
    public function testCreateAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $crawler = $client->request('GET', '/users/create');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton("Ajouter")->form();
        $form['user[username]'] = 'test';
        $form['user[password][first]'] = 'test';
        $form['user[password][second]'] = 'test';
        $form['user[email]'] = 'test@gmail.com';
        $form['user[roles][0]'] = 'ROLE_ADMIN';

        $client->submit($form);

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    /**
     * @covers \App\Controller\UserController::editAction
     */
    public function testEditAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $crawler = $client->request('GET', '/users/1/edit');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton("Modifier")->form();
        $form['user[username]'] = 'test';
        $form['user[password][first]'] = 'test';
        $form['user[password][second]'] = 'test';
        $form['user[email]'] = 'test@gmail.com';
        $form['user[roles][0]'] = 'ROLE_ADMIN';

        $client->submit($form);

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }
}