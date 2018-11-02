<?php

namespace Luniar\Alma\Contracts;

use Luniar\Alma\Contracts\Context;

interface Parser
{
    public function parse(string $contents, Context $context): void;
    public function parseCompiled(array $compiled, Context $context): void;
    public function precompile(array $contents, Context $context, array $tokens, array $result = []): array;
}
