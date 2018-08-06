<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Token as TokenContract;

abstract class Token implements TokenContract
{
    public abstract function key() : string;
    public abstract function expression() : string;
    public abstract function handle(Context $context, array $matches): void;

    public function matches(string $line): bool
    {
        return $this->getMatches($line) !== null;
    }

    public function getMatches(string $line): ?array
    {
        $matches = [];

        return preg_match($this->expression(), $line, $matches) ? $matches : null;
    }

}
