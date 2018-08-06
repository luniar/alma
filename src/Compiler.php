<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Compiler as CompilerContract;
use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Parser;

class Compiler implements CompilerContract
{
    public function compileFromFile(string $path, Context $context)
    {
        return $this->compile(file_get_contents($path), $context);
    }

    public function compile(string $contents, Context $context)
    {
        (new Parser($context))->parse($contents);

        return $context->handle();
    }

}
