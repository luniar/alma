<?php

namespace Luniar\Alma\Tests\Stubs\Concepts;

use Luniar\Alma\Concept;
use Luniar\Alma\Tests\Stubs\Concepts\Listener\ListenFragment;

class ListenerConcept extends Concept
{
    protected $fragments = [
        ListenFragment::class,
    ];
}
