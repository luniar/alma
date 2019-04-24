<?php

namespace Luniar\Alma\Tests\Stubs\Groups\Shared;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Token;
use SRL\Builder;

class SayToken extends Token
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
