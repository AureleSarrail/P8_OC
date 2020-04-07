<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{

    public function providerUrls()
    {
        return [
            ['/tasks'],
            ['/tasks/create'],
            ['/tasks/4/edit'],
            ['/tasks/4/toggle'],
            ['/tasks/4/delete']
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

    /**
     * @covers \AppBundle\Controller\TaskController::listAction
     */
    public function testListAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $client->request('GET', '/tasks');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @covers \AppBundle\Controller\TaskController::createAction
     */
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

    /**
     * @covers \AppBundle\Controller\TaskController::editAction
     */
    public function testEditAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $crawler = $client->request('GET', '/tasks/4/edit');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $form =  $crawler->selectButton("Modifier")->form();

        $form['task[title]'] = 'test';
        $form['task[content]'] = 'content';

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    /**
     * @covers \AppBundle\Controller\TaskController::toggleTaskAction
     */
    public function testToggleTaskAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $client->request('GET', '/tasks/4/toggle');

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    /**
     * @covers \AppBundle\Controller\TaskController::deleteTaskAction
     */
    public function testDeleteTaskAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Xan',
            'PHP_AUTH_PW' => 'manson'
        ]);
        $client->request('GET', '/tasks/4/delete');

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }
}