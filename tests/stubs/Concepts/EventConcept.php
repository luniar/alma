<?php

namespace Luniar\Alma\Tests\Stubs\Concepts;

use Luniar\Alma\Concept;
use Luniar\Alma\Tests\Stubs\Concepts\Shared\Say;
use Luniar\Alma\Tests\Stubs\Concepts\Event\EventFinish;
use Luniar\Alma\Tests\Stubs\Concepts\Event\EventStart;

class EventConcept extends Concept
{
    protected $fragments = [
        EventStart::class,
        Say::class,
        EventFinish::class,
    ];
}
