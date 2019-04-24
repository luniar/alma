<?php

namespace Luniar\Alma\Contracts;

use SRL\Builder;

interface Concept
{
    public function startsWith(Builder $expression): string;
    public function handle(Context $context, array $matches): void;
}
