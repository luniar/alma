<?php

namespace Luniar\Alma\Contracts;

interface Fragmentable
{
    public function matches(string $line): bool;
}
