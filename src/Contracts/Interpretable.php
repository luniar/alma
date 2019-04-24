<?php

namespace Luniar\Alma\Contracts;

interface Interpretable
{
    public function getMatches(string $line): ?array;
    public function matches(string $line): bool;
}
