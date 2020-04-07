<?php


namespace AppBundle\Entity;

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testGet()
    {
        $task = new Task();

        $task->setTitle('test');
        $title = $task->getTitle();

        $this->assertSame('test', $title);

        $task->setContent('test');
        $content = $task->getContent();

        $this->assertSame('test', $content);
        $this->assertSame(false, $task->isDone());

        $task->toggle(!$task->isDone());

        $this->assertSame(true, $task->isDone());
    }
}