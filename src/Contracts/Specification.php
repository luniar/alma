<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;

interface Specification
{
    public function tokens(): array;
    public function matches(string $line): bool;
    public function handle(Context $context, array $contents, int $index);
}
