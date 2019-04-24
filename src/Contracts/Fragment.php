<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Fragmentable;
use SRL\Builder;

interface Fragment extends Fragmentable
{
    public function key(): string;
    public function expression(Builder $expression): string;
    public function handle(Context $context, array $matches): void;
    public function getMatches(string $line): ?array;
}
