<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Group as GroupContract;
use Luniar\Alma\TokenResolver;

abstract class Group implements GroupContract
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
