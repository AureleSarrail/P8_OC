<?php

namespace Tests\AppBundle\Controller;

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
     */
    public function testUrls($url)
    {
        $client = static::createClient([], [
            'PHP_USER_AUTH' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $client->request('GET', $url);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

//    public function testUrlsNotAuth($url)
//    {
//        $client = static::createClient();
//        $client->request('GET', $url);
//
//        $this->assertSame(302, $client->getResponse()->getStatusCode());
//    }

    public function testCreateAction()
    {
        $client = static::createClient([], [
            'PHP_USER_AUTH' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $crawler = $client->request('GET', '/users/create');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton("Ajouter")->form();
        $form['user[username]'] = 'test';
        $form['user[password][first]'] = 'test';
        $form['user[password][second]'] = 'test';
        $form['user[email]'] = 'test@gmail.com';

        $client->submit($form);

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testEditAction()
    {
        $client = static::createClient([], [
            'PHP_USER_AUTH' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $crawler = $client->request('GET', '/users/1/edit');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton("Modifier")->form();
        $form['user[username]'] = 'test';
        $form['user[password][first]'] = 'test';
        $form['user[password][second]'] = 'test';
        $form['user[email]'] = 'test@gmail.com';

        $client->submit($form);

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }
}