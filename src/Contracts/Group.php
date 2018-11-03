<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Tokenable;
use Luniar\Alma\Contracts\TokenGroup;

interface Group extends Tokenable, TokenGroup
{
    public function tokens(): array;
}
