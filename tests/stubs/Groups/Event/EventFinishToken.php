<?php

namespace Luniar\Alma\Tests\Stubs\Groups\Event;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Token;
use SRL\Builder;

class EventFinishToken extends Token
{
    public function key() : string
    {
        return 'EVENT_FINISH';
    }

    public function expression(Builder $expression) : string
    {
        return $expression->literally('}')->mustEnd();
    }

    public function handle(Context $context, array $matches): void
    {
        $context->finish();
    }

}
