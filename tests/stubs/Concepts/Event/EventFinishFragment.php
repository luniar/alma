<?php

namespace Luniar\Alma\Tests\Stubs\Concepts\Event;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Fragment;
use SRL\Builder;

class EventFinishFragment extends Fragment
{
    public function key() : string
    {
        return 'EVENT_FINISH';
    }

    public function expression(Builder $expression) : string
    {
        return $expression->literally('}')->mustEnd();
    }

    public function handle(Context $context, array $matches): void
    {
        $context->finish();
    }

}
