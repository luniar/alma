<?php

namespace Luniar\Alma\Tests\Stubs\Specifications;

use Luniar\Alma\Specification;
use Luniar\Alma\Tests\Stubs\Specifications\Shared\SayToken;
use Luniar\Alma\Tests\Stubs\Specifications\Event\EventFinishToken;
use Luniar\Alma\Tests\Stubs\Specifications\Event\EventStartToken;

class EventSpecification extends Specification
{
    public function tokens() : array
    {
        return [
            new EventStartToken,
            new SayToken,
            new EventFinishToken,
        ];
    }
}
