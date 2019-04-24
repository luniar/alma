<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Fragmentable;
use Luniar\Alma\Contracts\FragmentConcept;

interface Concept extends Fragmentable, FragmentConcept
{
    public function fragments(): array;
}
