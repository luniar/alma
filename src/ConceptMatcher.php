<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Concept;
use Luniar\Alma\Contracts\MultilineConcept;
use SRL\Builder;

class ConceptMatcher
{
    public static function startsWith(Concept $concept, string $line): bool
    {
        return self::matches($concept->startsWith(new Builder), $line) !== null;
    }

    public static function endsWith(MultilineConcept $concept, string $line): bool
    {
        return self::matches($concept->endsWith(new Builder), $line) !== null;
    }

    public static function getMatches(Concept $concept, string $line): ?array
    {
        return self::matches($concept->startsWith(new Builder), $line);
    }

    protected static function matches(string $expression, string $line): ?array
    {
        $matches = [];

        return preg_match($expression, $line, $matches) ? $matches : null;
    }
}
