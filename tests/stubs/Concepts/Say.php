<?php

namespace Luniar\Alma\Tests\Stubs\Concepts;

use Luniar\Alma\Contracts\Concept;
use Luniar\Alma\Contracts\Context;
use SRL\Builder;

class Say implements Concept
{
    public function startsWith(Builder $expression) : string
    {
        return $expression->literally('@say')
            ->whitespace()
            ->oneOf('"\'')
            ->capture(function (Builder $expression) {
                $expression->any()->onceOrMore();
            }, 'text')
            ->oneOf('"\'')->mustEnd();
    }

    public function handle(Context $context, array $matches): void
    {
        $context->commit('say', $matches['text']);
    }

}
