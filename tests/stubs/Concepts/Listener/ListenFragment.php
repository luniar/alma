<?php

namespace Luniar\Alma\Tests\Stubs\Concepts\Listener;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Fragment;
use SRL\Builder;

class ListenFragment extends Fragment
{
    public function key() : string
    {
        return 'LISTEN_TO_EVENT';
    }

    public function expression(Builder $expression) : string
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
