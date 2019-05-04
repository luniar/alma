<?php

namespace Luniar\Alma\Contracts;

interface Compiler
{
    public function compile(string $contents, array $concepts);
    public function compileFromFile(string $path, array $concepts);
}
