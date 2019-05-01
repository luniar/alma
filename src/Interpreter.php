<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\MultilineConcept;

class Interpreter
{
    public function interpret(array $compiled, Context $context)
    {
        foreach ($compiled as $block) {
            $concept = new $block['key'];

            $concept->handle($context, $block['matches']);

            if (is_array($block['value'])) {
                $this->interpret($block['value'], $context);
            }

            if ($concept instanceof MultilineConcept) {
                $concept->close($context);
            }
        }

        return $context->handle();
    }
}
