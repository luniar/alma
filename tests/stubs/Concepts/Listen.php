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
            })
            ->caseInsensitive();
    }

    public function handle(Context $context, array $matches): void
    {
        $context->group('listeners')->begin($matches[1]);
        $context->commit('listen', $matches[1]);
        $context->finish();
    }

}
