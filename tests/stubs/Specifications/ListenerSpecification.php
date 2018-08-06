<?php

namespace Luniar\Alma\Tests\Stubs\Specifications;

use Luniar\Alma\Specification;
use Luniar\Alma\Tests\Stubs\Specifications\Listener\ListenToken;

class ListenerSpecification extends Specification
{
    protected $tokens = [
        ListenToken::class,
    ];
}
