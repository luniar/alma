<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Parser as ParserContract;
use Luniar\Alma\Contracts\Group;
use Luniar\Alma\Contracts\Token;
use Luniar\Alma\Contracts\TokenGroup;
use Luniar\Alma\TokenResolver;
use \InvalidArgumentException;

class Parser implements ParserContract
{
    public function parse(string $contents, Context $context): void
    {
        $contents = explode(PHP_EOL, $contents);

        $this->parseCompiled(
            $this->precompile($contents, $context, $context->tokens(), []),
            $context
        );
    }

    public function parseCompiled(array $compiled, Context $context): void
    {
        if (count($compiled) == 0) {
            return;
        }

        $block = array_shift($compiled);

        if (is_array($block['value'])) {
            $this->parseCompiled($block['value'], $context);
            $this->parseCompiled($compiled, $context);
            return;
        }

        $token = new $block['key'];
        $token->handle($context, $block['matches']); // could also pass the args here..

        $this->parseCompiled($compiled, $context);
    }

    public function precompile(array $contents, Context $context, array $tokens, array $result = []): array
    {
        if (count($contents) == 0) {
            return $result;
        }

        $line = trim(array_shift($contents));

        $result = $this->compileTokens($contents, $context, $tokens, $line, $result);

        return $this->precompile($contents, $context, $tokens, $result);
    }

    protected function compileGroup(Token $last, array &$contents, Context $context, array $tokens, array $result): array
    {
        if (count($contents) == 0) {
            return $result;
        }

        $line = trim(array_shift($contents));

        if ($last->matches($line)) {
            $result[] = $this->formatToken($last, $line);
            return $result;
        }

        $result = $this->compileTokens($contents, $context, $tokens, $line, $result);

        return $this->compileGroup($last, $contents, $context, $tokens, $result);
    }

    protected function compileTokens(array &$contents, Context $context, array $tokens, string $line, array $result): array
    {
        foreach ($tokens as $token) {
            $token = TokenResolver::resolve($token);

            if (! $token->matches($line)) {
                continue;
            }

            if ($token instanceof Token) {
                $result[] = $this->formatToken($token, $line);
                break;
            }

            if ($token instanceof TokenGroup) {
                $spec = $token; // alias just to improve reading
                $newTokens = $spec->tokens();
                $lastToken = array_pop($newTokens);

                $groupResult = $this->compileGroup(
                    new $lastToken,
                    $contents,
                    $context,
                    $spec->tokens(),
                    []
                );

                $result[] = $this->formatTokenGroup($spec, $line, $groupResult);
                break;
            }

            throw new InvalidArgumentException('An invalid token was passed to the parser.');
        }

        return $result;
    }

    protected function formatToken(Token $token, string $line): array
    {
        return [
            'key' => get_class($token),
            'value' => $line,
            'args' => [],
            'matches' => $token->getMatches($line),
        ];
    }

    protected function formatTokenGroup(Group $spec, string $line, array $group): array
    {
        $tokenClass = $spec->tokens()[0];
        $token = new $tokenClass;

        return [
            'key' => get_class($spec),
            'value' => array_merge([[
                'key' => $tokenClass,
                'value' => $line,
                'args' => [],
                'matches' => $token->getMatches($line),
            ]], $group),
            'args' => [],
        ];
    }

}
