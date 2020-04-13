<?php


namespace App\Tests\Entity;

use App\Entity\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testGet()
    {
        $task = new Task();

//        $task->setCreatedAt(new \DateTime('2011-01-01T15:03:01.012345Z'));

//        $this->assertEquals('2011-01-01T15:03:01.012345Z', $task->getCreatedAt());

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