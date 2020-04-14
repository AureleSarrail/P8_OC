<?php

namespace App\DataFixtures\Processor;

use Fidry\AliceDataFixtures\ProcessorInterface;
use App\Entity\Task;

final class TaskProcessor implements ProcessorInterface
{
    /**
     * @inheritdoc
     */
    public function preProcess(string $fixtureId, $object): void
    {
        if (!$object instanceof Task) {
            return;
        }

        $alea = rand(0,1);

        if ($alea == 1) {
            $object->toggle(!$object->isDone());
        }
    }

    /**
     * @inheritdoc
     */
    public function postProcess(string $fixtureId, $object): void
    {
        // do nothing
    }
}