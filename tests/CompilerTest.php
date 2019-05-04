<?php

namespace Luniar\Alma\Tests;

use Luniar\Alma\Compiler;
use Luniar\Alma\Tests\Stubs\Concepts\Listen;
use Luniar\Alma\Tests\Stubs\Contexts\EventsContext;
use PHPUnit\Framework\TestCase;

class CompilerTest extends TestCase
{
    protected $compiler;
    protected $context;

    public function setUp()
    {
        $this->compiler = new Compiler();
        $this->context = new EventsContext;
    }

    /** @test */
    function it_compiles_raw_contents()
    {
        $result = $this->compiler->compile('@listen test', $this->context->concepts());

        $this->assertEquals(count($result), 1);
        $this->assertEquals($result[0]['key'], Listen::class);
        $this->assertEquals($result[0]['value'], '@listen test');
        $this->assertArraySubset(['@listen test', 'test'], $result[0]['matches']);
    }

    /** @test */
    function it_compiles_contents_from_a_file()
    {
        $result = $this->compiler->compileFromFile(__DIR__ . '/stubs/events.alma', $this->context->concepts());

        $precompiled = require 'compiled/events.php';

        $this->assertEquals($precompiled, $result);
    }
}
