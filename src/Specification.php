<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Specification as SpecificationContract;
use Luniar\Alma\TokenResolver;

abstract class Specification implements SpecificationContract
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
