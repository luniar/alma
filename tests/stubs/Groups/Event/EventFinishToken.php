<?php

namespace Luniar\Alma\Tests\Stubs\Groups\Event;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Token;

class EventFinishToken extends Token
{
    public function key() : string
    {
        return 'EVENT_FINISH';
    }

    public function expression() : string
    {
        return '/^}/';
    }

    public function handle(Context $context, array $matches): void
    {
        $context->finish();
    }

}
