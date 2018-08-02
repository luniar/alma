<?php

namespace Luniar\Alma\Tests\Stubs\Specifications\Event;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Token;

class EventStartToken extends Token
{
    public function key() : string
    {
        return 'EVENT_START';
    }

    public function expression() : string
    {
        return '/^([a-zA-Z]+)\s+{/';
    }

    public function handle(Context $context, array $matches): void
    {
        $context->group('events')->begin($matches[1], [
            'event' => $matches[1],
        ]);
    }

}
