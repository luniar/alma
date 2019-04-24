<?php

namespace Luniar\Alma\Tests\Stubs\Concepts\Event;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Token;
use SRL\Builder;

class EventStartToken extends Token
{
    public function key() : string
    {
        return 'EVENT_START';
    }

    public function expression(Builder $expression) : string
    {
        return $expression->startsWith()
            ->capture(function (Builder $expression) {
                $expression->letter()->atLeast(2);
            }, 'eventName')
            ->whitespace()->onceOrMore()
            ->literally('{')->mustEnd()->caseInsensitive();
    }

    public function handle(Context $context, array $matches): void
    {
        $context->group('events')->begin($matches['eventName'], [
            'event' => $matches['eventName'],
        ]);
    }

}
