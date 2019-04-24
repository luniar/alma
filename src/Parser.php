<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Parser as ParserContract;
use Luniar\Alma\Contracts\Concept;
use Luniar\Alma\Contracts\Fragment;
use Luniar\Alma\Contracts\FragmentConcept;
use Luniar\Alma\FragmentResolver;
use \InvalidArgumentException;

class Parser implements ParserContract
{
    public function parse(array $contents, Context $context): void
    {
        $this->parseCompiled(
            $this->precompile($contents, $context, $context->fragments(), []),
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

        $fragment = new $block['key'];
        $fragment->handle($context, $block['matches']); // could also pass the args here..

        $this->parseCompiled($compiled, $context);
    }

    public function precompile(array $contents, Context $context, array $fragments, array $result = []): array
    {
        if (count($contents) == 0) {
            return $result;
        }

        $line = trim(array_shift($contents));

        $result = $this->compileFragments($contents, $context, $fragments, $line, $result);

        return $this->precompile($contents, $context, $fragments, $result);
    }

    protected function compileConcept(Fragment $last, array &$contents, Context $context, array $fragments, array $result): array
    {
        if (count($contents) == 0) {
            return $result;
        }

        $line = trim(array_shift($contents));

        if ($last->matches($line)) {
            $result[] = $this->formatFragment($last, $line);
            return $result;
        }

        $result = $this->compileFragments($contents, $context, $fragments, $line, $result);

        return $this->compileConcept($last, $contents, $context, $fragments, $result);
    }

    protected function compileFragments(array &$contents, Context $context, array $fragments, string $line, array $result): array
    {
        foreach ($fragments as $fragment) {
            $fragment = FragmentResolver::resolve($fragment);

            if (! $fragment->matches($line)) {
                continue;
            }

            if ($fragment instanceof Fragment) {
                $result[] = $this->formatFragment($fragment, $line);
                break;
            }

            if ($fragment instanceof FragmentConcept) {
                $group = $fragment; // alias just to improve reading
                $newFragments = $group->fragments();
                $lastFragment = array_pop($newFragments);

                $groupResult = $this->compileConcept(
                    new $lastFragment,
                    $contents,
                    $context,
                    $group->fragments(),
                    []
                );

                $result[] = $this->formatFragmentConcept($group, $line, $groupResult);
                break;
            }

            throw new InvalidArgumentException('An invalid fragment was passed to the parser.');
        }

        return $result;
    }

    protected function formatFragment(Fragment $fragment, string $line): array
    {
        return [
            'key' => get_class($fragment),
            'type' => 'fragment',
            'value' => $line,
            'matches' => $fragment->getMatches($line),
        ];
    }

    protected function formatFragmentConcept(Concept $group, string $line, array $result): array
    {
        $fragmentClass = $group->fragments()[0];
        $fragment = new $fragmentClass;

        return [
            'key' => get_class($group),
            'type' => 'concept',
            'value' => array_merge([$this->formatFragment($fragment, $line)], $result),
        ];
    }

}
