<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Context as ContextContract;

abstract class Context implements ContextContract
{
    protected $state;

    public function __construct()
    {
        $this->state = new State();
    }

    public abstract function fragments(): array;
    public abstract function handle();

    public function group(string $group): ContextContract
    {
        $this->state->group($group);

        return $this;
    }

    public function commit(string $key, $arguments): ContextContract
    {
        call_user_func_array([$this, $key], [$arguments]);

        return $this;
    }

    public function begin(string $key, array $arguments = []): ContextContract
    {
        $this->state->create($key, $arguments);

        return $this;
    }

    public function finish(): void
    {
        $this->state->merge();
    }
}
