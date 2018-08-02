<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Specification as SpecificationContract;
use Luniar\Alma\Exceptions\InvalidSyntaxException;

abstract class Specification implements SpecificationContract
{
	protected $tokens = [];

    public function __construct()
    {
        $this->tokens = $this->tokens();
    }

    public abstract function tokens() : array;

    public function matches(string $line): bool
    {
        return $this->tokens[0]->getMatches($line) !== null;
    }

    public function handle(Context $context, array $contents, int $index)
    {
        $length = count($contents);
        $last = count($this->tokens) - 1;

        for (; $index < $length; $index++) {
            $line = trim($contents[$index]);

            foreach ($this->tokens as $key => $token) {
                $matches = $token->getMatches($line);

                if (! $matches) {
                    continue;
                }

                $token->handle($context, $matches);

                if ($key === $last) {
                    return $index;
                }
            }
        }

        throw new InvalidSyntaxException;
    }
}
