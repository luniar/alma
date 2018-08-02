<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;

interface Compiler
{
    public function compile(string $contents, Context $context);
    public function compileFromFile(string $path, Context $context);
}
