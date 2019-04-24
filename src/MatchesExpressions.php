<?php

namespace Luniar\Alma;

use SRL\Builder;

trait MatchesExpressions
{
    public function matches(string $line): bool
    {
        return $this->getMatches($line) !== null;
    }

    public function getMatches(string $line): ?array
    {
        $matches = [];

        return preg_match($this->expression(new Builder), $line, $matches) ? $matches : null;
    }
}
