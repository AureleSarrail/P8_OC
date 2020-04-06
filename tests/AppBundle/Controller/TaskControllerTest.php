<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{

    public function providerUrls()
    {
        return [
            ['/tasks'],
            ['/tasks/create'],
            ['/tasks/2/edit'],
            ['/tasks/2/toggle'],
            ['/tasks/2/delete']
        ];
    }

    /**
     * @dataProvider providerUrls
     */
    public function testRoutesNotAuth($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertSame(302, $client->getResponse()->getStatusCode());
    }

    public function testListAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $client->request('GET', '/tasks');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testCreateAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'test';
        $form['task[content]'] = 'test';
        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testEditAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $crawler = $client->request('GET', '/tasks/3/edit');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $form =  $crawler->selectButton("Modifier")->form();

        $form['task[title]'] = 'test';
        $form['task[content]'] = 'content';

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testToggleTaskAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $client->request('GET', '/tasks/3/toggle');

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testDeleteTaskAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $client->request('GET', '/tasks/3/delete');

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }
}