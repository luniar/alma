<?php

namespace Luniar\Alma\Tests\Stubs\Contexts;

use Luniar\Alma\Context;
use Luniar\Alma\Tests\Stubs\Specifications\EventSpecification;
use Luniar\Alma\Tests\Stubs\Specifications\Listener\ListenToken;
use Luniar\Alma\Tests\Stubs\Specifications\ListenerSpecification;

class EventsContext extends Context
{

    public function handle()
    {
        return $this->state->get();
    }

    public function tokens() : array
    {
        return [
            new EventSpecification,
            new ListenToken,
        ];
    }

    protected function listen($event)
    {
        $this->state->push($event);
    }

    public function say($message)
    {
        $this->state->push('actions', [
            'class' => 'SayAction',
            'message' => $message,
        ]);
    }
}
