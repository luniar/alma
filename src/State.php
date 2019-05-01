<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\State as StateContract;

class State implements StateContract
{
    protected $state = [];
    protected $previous = [];
    protected $current;
    protected $keys = [];
    protected $group;

    public function get()
    {
        return $this->state;
    }

    public function create(string $key, array $arguments = []): void
    {
        $this->previous[] = $this->current;
        $this->keys[] = $key;
        $this->current = $arguments;
    }

    public function push($key, $arguments = null): void
    {
        if ($arguments === null) {
            $this->current[] = $key;
            return;
        }

        $this->current[$key][] = $arguments;
    }

    public function set($key, $arguments = null): void
    {
        if ($arguments === null) {
            $this->current[] = $key;
            return;
        }

        $this->current[$key] = $arguments;
    }

    public function current()
    {
        return $this->current;
    }

    public function parent()
    {
        return $this->previous[count($this->previous) - 1];
    }

    public function group(string $group): void
    {
        $this->group = $group;
    }

    public function merge(): void
    {
        if (count($this->previous) > 1) {
            $this->current = array_merge(array_pop($this->previous) ?? [], [array_pop($this->keys) => $this->current]);
            return;
        }

        if ($this->group === null) {
            $this->state[array_pop($this->keys)] = $this->current;
        } else {
            $this->state[$this->group][array_pop($this->keys)] = $this->current;
        }

        $this->current = null;
        $this->previous = [];
        $this->keys = [];
        $this->group = null;
    }
}
