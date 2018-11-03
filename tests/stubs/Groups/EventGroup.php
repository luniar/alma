<?php

namespace Luniar\Alma\Tests\Stubs\Groups;

use Luniar\Alma\Group;
use Luniar\Alma\Tests\Stubs\Groups\Shared\SayToken;
use Luniar\Alma\Tests\Stubs\Groups\Event\EventFinishToken;
use Luniar\Alma\Tests\Stubs\Groups\Event\EventStartToken;

class EventGroup extends Group
{
    protected $tokens = [
        EventStartToken::class,
        SayToken::class,
        EventFinishToken::class,
    ];
}
