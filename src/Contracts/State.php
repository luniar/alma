<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;

interface State
{
    public function create(string $key, array $arguments = []): void;
    public function push($key, $arguments = null): void;
    public function set($key, $arguments = null): void;

    public function current();
    public function parent();
    public function group(string $group): void;
    public function merge(): void;
}
