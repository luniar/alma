<?php

namespace Luniar\Alma\Tests\Stubs\Concepts;

use Luniar\Alma\Concept;
use Luniar\Alma\Tests\Stubs\Concepts\Shared\SayFragment;
use Luniar\Alma\Tests\Stubs\Concepts\Event\EventFinishFragment;
use Luniar\Alma\Tests\Stubs\Concepts\Event\EventStartFragment;

class EventConcept extends Concept
{
    protected $fragments = [
        EventStartFragment::class,
        SayFragment::class,
        EventFinishFragment::class,
    ];
}
