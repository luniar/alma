<?php

namespace Luniar\Alma\Tests\Stubs\Concepts\Event;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Fragment;
use SRL\Builder;

class EventStart extends Fragment
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
