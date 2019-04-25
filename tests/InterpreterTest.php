<?php

namespace Luniar\Alma\Tests;

use Luniar\Alma\Interpreter;
use Luniar\Alma\Tests\Stubs\Contexts\EventsContext;
use PHPUnit\Framework\TestCase;

class InterpreterTest extends TestCase
{
    protected $compiler;
    protected $context;

    public function setUp()
    {
        $this->interpreter = new Interpreter();
        $this->context = new EventsContext;
    }

    /** @test */
    function it_interprets_contents_from_a_compiled_source()
    {
        $expected = require 'interpretations/events_context.php';

        $compiled = require 'compiled/events.php';

        $result = $this->interpreter->interpret($compiled, $this->context);

        $this->assertEquals($result, $expected);
    }
}
