<?php

namespace Luniar\Alma\Tests\Stubs\Groups;

use Luniar\Alma\Group;
use Luniar\Alma\Tests\Stubs\Groups\Listener\ListenToken;

class ListenerGroup extends Group
{
    protected $tokens = [
        ListenToken::class,
    ];
}
