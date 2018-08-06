<?php

namespace Luniar\Alma\Contracts;

interface Tokenable
{
    public function matches(string $line): bool;
}
