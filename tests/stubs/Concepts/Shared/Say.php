<?php

namespace Luniar\Alma\Tests\Stubs\Concepts\Shared;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Fragment;
use SRL\Builder;

class Say extends Fragment
{
    public function key() : string
    {
        return 'SAY_TOKEN';
    }

    public function expression(Builder $expression) : string
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
