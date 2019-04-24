<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Tokenable;
use Luniar\Alma\Contracts\TokenConcept;

interface Concept extends Tokenable, TokenConcept
{
    public function tokens(): array;
}
