<?php

namespace Luniar\Alma\Tests;

use Luniar\Alma\Compiler;
use Luniar\Alma\Parser;
use Luniar\Alma\Tests\Stubs\Contexts\EventsContext;
use PHPUnit\Framework\TestCase;

class CompilerTest extends TestCase
{
    protected $compiler;
    protected $context;
    protected $result;

    public function setUp()
    {
        $this->compiler = new Compiler(new Parser);
        $this->context = new EventsContext;
    }

    /** @test */
    function it_compiles_contents_from_a_file()
    {
        $result = $this->compiler->compileFromFile(__DIR__ . '/stubs/events.alma', $this->context);

        $response = require 'responses/events_context.php';
        $this->assertEquals($response, $result);
    }

    /** @test */
    function it_compiles_raw_contents()
    {
        $result = $this->compiler->compile('@listen test', $this->context);

        $this->assertArrayHasKey('listeners', $result);
        $this->assertArrayHasKey('test', $result['listeners']);
    }
}
