<?php

namespace Luniar\Alma\Tests\Stubs\Concepts;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\MultilineConcept;
use Luniar\Alma\Tests\Stubs\Concepts\Say;
use SRL\Builder;

class Event implements MultilineConcept
{
    public function concepts(): array
    {
        return [
            new Say,
        ];
    }

    public function startsWith(Builder $expression): string
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

    public function endsWith(Builder $expression): string
    {
        return $expression->literally('}')->mustEnd();
    }

    public function close(Context $context): void
    {
        $context->finish();
    }
}
