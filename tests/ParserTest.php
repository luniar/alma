<?php

namespace Luniar\Alma\Tests;

use Luniar\Alma\Contracts\Context;
use Luniar\Alma\Contracts\Token;
use Luniar\Alma\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /** @test */
    function it_is_able_to_compile_and_handle_dsl_files()
    {
        $context = $this->createContext(function ($context) {
            $context->method('tokens')->willReturn([
                $this->createToken('@example')
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

    protected function createToken($key, $closure = null)
    {
        $stub = $this->createMock(Token::class);

        $stub->method('key')->willReturn($key);
        $stub->method('expression')->willReturn('/^'.$key.'/');
        $self = $this;

        if ($closure != null) {
            $closure($stub, $self);
        }

        return $stub;
    }
}
