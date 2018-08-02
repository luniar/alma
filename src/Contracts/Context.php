<?php

namespace Luniar\Alma\Contracts;

interface Context
{
    public function specifications(): array;
    public function handle();
    public function group(string $group): Context;

    public function commit(string $key, $arguments): Context;
    public function begin(string $key, array $arguments = []): Context;
    public function finish(): void;
}
