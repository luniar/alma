<?php

namespace Luniar\Alma\Tests;

use Luniar\Alma\Compiler;
use Luniar\Alma\Tests\Stubs\Contexts\EventsContext;
use PHPUnit\Framework\TestCase;

class CompilerTest extends TestCase
{
    protected $compiler;
    protected $context;
    protected $result;

    public function setUp()
    {
        $this->compiler = new Compiler;
        $this->context = new EventsContext;

        $this->result = $this->compiler->compile(__DIR__ . '/stubs/events.alma', $this->context);
    }

    /** @test */
    function it_compiles_contents_from_a_file()
    {
        $this->compiler = new Compiler;
        $this->context = new EventsContext;

        $this->result = $this->compiler->compileFromFile(__DIR__ . '/stubs/events.alma', $this->context);

        $response = require 'responses/events_context.php';

        $this->assertEquals($response, $this->result);
    }

    /** @test */
    function it_compiles_raw_contents()
    {
        $result = (new Compiler)->compile('@listen test', new EventsContext);

        $this->assertArrayHasKey('test', $result['listeners']);
    }
}
