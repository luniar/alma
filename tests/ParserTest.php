<?php

namespace Luniar\Alma\Tests;

use Luniar\Alma\Contracts\Concept;
use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /** @test */
    function it_is_able_to_compile_and_handle_dsl_files()
    {
        $context = $this->createContext(function ($context) {
            $context->method('concepts')->willReturn([
                $this->createFragment('@example')
            ]);

            $context->method('handle')->willReturn([

            ]);
        });

        (new Parser)->parse(['@example'], $context);
    }

    protected function createContext($closure)
    {
        $stub = $this->createMock(Context::class);

        $closure($stub);

        return $stub;
    }

    protected function createFragment($key, $closure = null)
    {
        $stub = $this->createMock(Concept::class);

        $stub->method('startsWith')->willReturn('/^'.$key.'/');
        $self = $this;

        if ($closure != null) {
            $closure($stub, $self);
        }

        return $stub;
    }
}
