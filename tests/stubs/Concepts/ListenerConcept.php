<?php

namespace Luniar\Alma\Tests\Stubs\Concepts;

use Luniar\Alma\Concept;
use Luniar\Alma\Tests\Stubs\Concepts\Listener\ListenToken;

class ListenerConcept extends Concept
{
    protected $tokens = [
        ListenToken::class,
    ];
}
