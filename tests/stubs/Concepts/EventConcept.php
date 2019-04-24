<?php

namespace Luniar\Alma\Tests\Stubs\Concepts;

use Luniar\Alma\Concept;
use Luniar\Alma\Tests\Stubs\Concepts\Shared\SayToken;
use Luniar\Alma\Tests\Stubs\Concepts\Event\EventFinishToken;
use Luniar\Alma\Tests\Stubs\Concepts\Event\EventStartToken;

class EventConcept extends Concept
{
    protected $tokens = [
        EventStartToken::class,
        SayToken::class,
        EventFinishToken::class,
    ];
}
