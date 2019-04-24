<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Concept as ConceptContract;
use Luniar\Alma\TokenResolver;

abstract class Concept implements ConceptContract
{
	protected $tokens = [];

    public function tokens() : array
    {
        return $this->tokens;
    }

    public function matches(string $line): bool
    {
        return TokenResolver::resolve($this->tokens[0])->getMatches($line) !== null;
    }

}
