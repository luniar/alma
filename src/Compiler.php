<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Compiler as CompilerContract;
use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Parser;

class Compiler implements CompilerContract
{
    /**
     * @var \Luniar\Alma\Contracts\Parser
     */
    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function compileFromFile(string $path, Context $context)
    {
        return $this->compile(file_get_contents($path), $context);
    }

    public function compile(string $contents, Context $context)
    {
        $this->parser->parse($contents, $context);

        return $context->handle();
    }

}
