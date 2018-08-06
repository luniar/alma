<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Parser as ParserContract;
use Luniar\Alma\Contracts\Specification;
use Luniar\Alma\Contracts\Token;
use Luniar\Alma\Contracts\Tokenable;
use Luniar\Alma\Contracts\TokenGroup;
use Luniar\Alma\Exceptions\InvalidSyntaxException;

class Parser implements ParserContract
{
	protected $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function parse($contents)
    {
        $contents = explode(PHP_EOL, $contents);

        $this->parseContents($contents, $this->context->tokens());
    }

    protected function parseContents($contents, $tokens)
    {
        for ($index = 0; $index < count($contents); $index++) {
            $line = trim($contents[$index]);

            // Check for a specification beginning
            foreach ($tokens as $token) {
                if (! $token->matches($line)) {
                    continue;
                }

                if (! ($token instanceof Tokenable)) {
                    throw new IllegalArgumentException('An invalid token was passed to the parser.');
                }

                $this->handle(
                    $this->context,
                    $token instanceof TokenGroup ? $token->tokens() : [$token],
                    $contents,
                    $index
                );
            }
        }
    }

    protected function handle(Context $context, array $tokens, array $contents, int $index)
    {
        $length = count($contents);
        $last = count($tokens) - 1;

        for (; $index < $length; $index++) {
            $line = trim($contents[$index]);

            foreach ($tokens as $key => $token) {
                $token = TokenResolver::resolve($token);

                $matches = $token->getMatches($line);

                if (! $matches) {
                    continue;
                }

                $token->handle($this->context, $matches);

                if ($key === $last) {
                    return $index;
                }
            }
        }

        throw new InvalidSyntaxException;
    }
}
