<?php

namespace Luniar\Alma\Tests\Stubs\Specifications;

use Luniar\Alma\Specification;
use Luniar\Alma\Tests\Stubs\Specifications\Shared\SayToken;
use Luniar\Alma\Tests\Stubs\Specifications\Event\EventFinishToken;
use Luniar\Alma\Tests\Stubs\Specifications\Event\EventStartToken;

class EventSpecification extends Specification
{
    protected $tokens = [
        EventStartToken::class,
        SayToken::class,
        EventFinishToken::class,
    ];
}
