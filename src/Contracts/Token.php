<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;

interface Token
{
    public function key(): string;
    public function expression(): string;
    public function handle(Context $context, array $matches): void;
    public function getMatches(string $line): ?array;
}
