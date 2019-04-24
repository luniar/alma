<?php

namespace Luniar\Alma;

use Luniar\Alma\ConceptMatcher;
use Luniar\Alma\ConceptResolver;
use Luniar\Alma\Contracts\Concept;
use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\MultilineConcept;
use Luniar\Alma\Contracts\Parser as ParserContract;

class Parser implements ParserContract
{
    public function parse(array $contents, Context $context): void
    {
        $this->parseCompiled(
            $this->precompile($contents, $context, $context->concepts(), []),
            $context
        );
    }

    public function parseCompiled(array $compiled, Context $context): void
    {
        if (count($compiled) == 0) {
            return;
        }

        $block = array_shift($compiled);

        $concept = new $block['key'];
        $concept->handle($context, $block['matches']);

        if (is_array($block['value'])) {
            $this->parseCompiled($block['value'], $context);
        }

        if ($concept instanceof MultilineConcept) {
            $concept->close($context);
        }

        $this->parseCompiled($compiled, $context);
    }

    public function precompile(array $contents, Context $context, array $concepts, array $result = []): array
    {
        if (count($contents) == 0) {
            return $result;
        }

        $line = trim(array_shift($contents));

        $result = $this->compileConcepts($contents, $context, $concepts, $line, $result);

        return $this->precompile($contents, $context, $concepts, $result);
    }

    protected function compileConcept(MultilineConcept $concept, array &$contents, Context $context, array $concepts, array $result): array
    {
        if (count($contents) == 0) {
            return $result;
        }

        $line = trim(array_shift($contents));

        if (ConceptMatcher::endsWith($concept, $line)) {
            return $result;
        }

        if (count($concepts) > 0) {
            $result = $this->compileConcepts($contents, $context, $concepts, $line, $result);
        }

        return $this->compileConcept($concept, $contents, $context, $concepts, $result);
    }

    protected function compileConcepts(array &$contents, Context $context, array $concepts, string $line, array $result): array
    {
        foreach ($concepts as $concept) {
            $concept = ConceptResolver::resolve($concept);

            if (! ConceptMatcher::startsWith($concept, $line)) {
                continue;
            }

            if ($concept instanceof MultilineConcept) {
                $conceptResult = $this->compileConcept(
                    $concept,
                    $contents,
                    $context,
                    $concept->concepts(),
                    []
                );

                $result[] = $this->formatMultilineConcept($concept, $line, $conceptResult);
                break;
            }

            $result[] = $this->formatConcept($concept, $line);
            break;
        }

        return $result;
    }

    protected function formatConcept(Concept $concept, string $line): array
    {
        return [
            'key' => get_class($concept),
            'value' => $line,
            'matches' => ConceptMatcher::getMatches($concept, $line),
        ];
    }

    protected function formatMultilineConcept(MultilineConcept $concept, string $line, array $result): array
    {
        return [
            'key' => get_class($concept),
            'value' => $result,
            'matches' => ConceptMatcher::getMatches($concept, $line),
        ];
    }

}
