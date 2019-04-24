<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Fragment as FragmentContract;
use SRL\Builder;

abstract class Fragment implements FragmentContract
{
    public abstract function key() : string;
    public abstract function expression(Builder $expression) : string;
    public abstract function handle(Context $context, array $matches): void;

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
