<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Compiler as CompilerContract;
use Luniar\Alma\Contracts\Context;

class Compiler implements CompilerContract
{
    public function compileFromFile(string $path, Context $context)
    {
        return $this->compile(file_get_contents($path), $context);
    }

    public function compile(string $contents, Context $context)
    {
        $contents = explode(PHP_EOL, $contents);

        // Build context
        $this->buildContext($context, $contents);

        return $context->handle();
    }

    protected function buildContext(Context $context, array $contents)
    {
        // Load context specifications
        $specifications = $context->specifications();

        for ($index = 0; $index < count($contents); $index++) {
            $line = trim($contents[$index]);

            // Check for a specification beginning
            foreach ($specifications as $specification) {
                if (! $specification->matches($line)) {
                    continue;
                }

                $index = $specification->handle($context, $contents, $index);
            }
        }
    }

}
