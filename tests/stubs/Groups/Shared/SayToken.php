<?php

namespace Luniar\Alma\Tests\Stubs\Groups\Shared;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Token;

class SayToken extends Token
{
    public function key() : string
    {
        return 'SAY_TOKEN';
    }

    public function expression() : string
    {
        return '/^@say\s"(.+)"/';
    }

    public function handle(Context $context, array $matches): void
    {
        $context->commit('say', $matches[1]);
    }

}
