<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Concept;

class ConceptResolver
{
    public static function resolve($concept): Concept
    {
        if (is_string($concept)) {
            $concept = new $concept;
        }

        if ($concept instanceof Concept) {
            return $concept;
        }

        throw new InvalidArgumentException('Concept type is not recognized.');
    }
}
