<?php

namespace Luniar\Alma\Tests\Stubs\Groups\Listener;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Token;

class ListenToken extends Token
{
    public function key() : string
    {
        return 'LISTEN_TO_EVENT';
    }

    public function expression() : string
    {
        return '/^@listen\s+([a-zA-Z]+)/';
    }

    public function handle(Context $context, array $matches): void
    {
        $context->group('listeners')->begin($matches[1]);
        $context->commit('listen', $matches[1]);
        $context->finish();
    }

}
