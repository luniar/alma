<?php

namespace Luniar\Alma\Contracts;

use SRL\Builder;

interface MultilineConcept extends Concept
{
    public function concepts(): array;

    public function endsWith(Builder $expression): string;
    public function close(Context $context): void;
}
