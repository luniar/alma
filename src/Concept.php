<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Concept as ConceptContract;
use Luniar\Alma\FragmentResolver;

abstract class Concept implements ConceptContract
{
	protected $fragments = [];

    public function fragments() : array
    {
        return $this->fragments;
    }

    public function matches(string $line): bool
    {
        return FragmentResolver::resolve($this->fragments[0])->getMatches($line) !== null;
    }

}
