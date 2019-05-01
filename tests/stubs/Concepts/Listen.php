<?php

namespace Luniar\Alma\Tests\Stubs\Concepts;

use Luniar\Alma\Contracts\Concept;
use Luniar\Alma\Contracts\Context;
use SRL\Builder;

class Listen implements Concept
{
    public function startsWith(Builder $expression) : string
    {
        return $expression->startsWith()->literally('@listen')
            ->whitespace()->onceOrMore()
            ->capture(function (Builder $expression) {
                $expression->letter()->onceOrMore();
            }, 'event')
            ->caseInsensitive();
    }

    public function handle(Context $context, array $matches): void
    {
        $context->group('listeners')->begin($matches['event']);
        $context->commit('listen', $matches['event']);
        $context->finish();
    }

}
