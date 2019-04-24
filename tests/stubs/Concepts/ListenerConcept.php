<?php

namespace Luniar\Alma\Tests\Stubs\Concepts;

use Luniar\Alma\Concept;
use Luniar\Alma\Tests\Stubs\Concepts\Listener\Listen;

class ListenerConcept extends Concept
{
    protected $fragments = [
        Listen::class,
    ];
}
