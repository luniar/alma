<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Tokenable;

interface Token extends Tokenable
{
    public function key(): string;
    public function expression(): string;
    public function handle(Context $context, array $matches): void;
    public function getMatches(string $line): ?array;
}
