<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Compiler as CompilerContract;
use Luniar\Alma\ConceptMatcher;
use Luniar\Alma\ConceptResolver;
use Luniar\Alma\Contracts\Concept;
use Luniar\Alma\Contracts\MultilineConcept;

class Compiler implements CompilerContract
{

    public function compileFromFile(string $path, array $concepts)
    {
        return $this->compile(file_get_contents($path), $concepts);
    }

    public function compile(string $contents, array $concepts)
    {
        return $this->precompile($this->formatContents($contents), $concepts, []);
    }

    protected function formatContents(string $contents): array
    {
        return explode(PHP_EOL, $contents);
    }

    public function precompile(array $contents, array $concepts, array $result = []): array
    {
        if (count($contents) == 0) {
            return $result;
        }

        $line = trim(array_shift($contents));

        $result = $this->compileConcepts($contents, $concepts, $line, $result);

        return $this->precompile($contents, $concepts, $result);
    }

    protected function compileConcept(MultilineConcept $concept, array &$contents, array $concepts, array $result): array
    {
        if (count($contents) == 0) {
            return $result;
        }

        $line = trim(array_shift($contents));

        if (ConceptMatcher::endsWith($concept, $line)) {
            return $result;
        }

        if (count($concepts) > 0) {
            $result = $this->compileConcepts($contents, $concepts, $line, $result);
        }

        return $this->compileConcept($concept, $contents, $concepts, $result);
    }

    protected function compileConcepts(array &$contents, array $concepts, string $line, array $result): array
    {
        foreach ($concepts as $concept) {
            $concept = ConceptResolver::resolve($concept);

            if (! ConceptMatcher::startsWith($concept, $line)) {
                continue;
            }

            $value = $line;

            if ($concept instanceof MultilineConcept) {
                $value = $this->compileConcept(
                    $concept,
                    $contents,
                    $concept->concepts(),
                    []
                );
            }

            $result[] = $this->formatConcept($concept, $line, $value);
            break;
        }

        return $result;
    }

    protected function formatConcept(Concept $concept, string $line, $value): array
    {
        return [
            'key' => get_class($concept),
            'value' => $value,
            'matches' => ConceptMatcher::getMatches($concept, $line),
        ];
    }
}
