<?php

namespace Luniar\Alma\Tests;

use Luniar\Alma\State;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    protected $state;

    public function setUp()
    {
        $this->state = new State;
    }

    /** @test */
    function it_fetches_the_current_state()
    {
        $this->state->set('email', ['john@example.com']);

        $this->assertArrayHasKey('email', $this->state->current());
        $this->assertEquals('john@example.com', $this->state->current()['email'][0]);
    }

    /** @test */
    function it_fetches_the_parent_state()
    {
        $this->state->create('users', [
            'title' => 'Users',
        ]);

        $this->state->create('user', [
            'name' => 'John Doe',
        ]);

        $this->assertEquals([
            'title' => 'Users',
        ], $this->state->parent());
    }

    /** @test */
    function it_is_able_to_store_multiple_states()
    {
        $this->state->create('events', [
            'title' => 'Events',
        ]);

        $this->state->merge();

        $this->state->create('listeners', [
            'title' => 'Listeners',
        ]);

        $this->state->merge();

        $this->assertEquals([
            'events' => ['title' => 'Events',],
            'listeners' => ['title' => 'Listeners',],
        ], $this->state->get());
    }

    /** @test */
    function it_can_use_groups()
    {
        $this->state->group('events');
        $this->state->create('event', [
            'title' => 'Event',
        ]);

        $this->state->merge();

        $this->state->group('listeners');
        $this->state->create('listener', [
            'title' => 'Listener',
        ]);

        $this->state->merge();

        $this->assertEquals([
            'events' => ['event' => ['title' => 'Event',]],
            'listeners' => ['listener' => ['title' => 'Listener',]],
        ], $this->state->get());
    }

    /** @test */
    function it_is_able_to_add_new_items_to_previously_used_groups()
    {
        $this->state->group('events');
        $this->state->create('event-1', [
            'title' => 'Event 1',
        ]);

        $this->state->merge();

        $this->state->group('events');
        $this->state->create('event-2', [
            'title' => 'Event 2',
        ]);

        $this->state->merge();

        $this->assertEquals([
            'events' => [
                'event-1' => ['title' => 'Event 1',],
                'event-2' => ['title' => 'Event 2',]
            ],
        ], $this->state->get());
    }

    /** @test */
    function it_is_able_to_maintain_the_current_state_one_level_deep()
    {
        $this->state->create('user', [
            'name' => 'John Doe',
        ]);

        $this->assertTrue(count($this->state->get()) === 0);
        $this->assertTrue(count($this->state->current()) === 1);

        $this->state->set('email', 'john@example.com');

        $this->assertTrue(count($this->state->get()) === 0);
        $this->assertEquals([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ], $this->state->current());

        $this->state->merge();

        $this->assertEquals([
            'user' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ],
        ], $this->state->get());
        $this->assertTrue($this->state->current() === null);
    }

    /** @test */
    function it_is_able_to_maintain_the_current_state_two_levels_deep()
    {
        $this->state->create('users', [
            'title' => 'Users',
        ]);

        $this->state->create('user', [
            'name' => 'John Doe',
        ]);

        $this->state->set('email', 'john@example.com');

        $this->assertTrue(count($this->state->get()) === 0);
        $this->assertEquals([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ], $this->state->current());

        $this->state->merge();

        $this->assertEquals([
            'title' => 'Users',
            'user' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ],
        ], $this->state->current());

        $this->state->merge();

        $this->assertEquals([
            'users' => [
                'title' => 'Users',
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                ],
            ]
        ], $this->state->get());
        $this->assertTrue($this->state->current() === null);
    }

       /** @test */
    function it_is_able_to_maintain_the_current_state_multiple_levels_deep()
    {
        $users = rand(5, 10);

        $this->state->create('users', [
            'title' => 'Users',
        ]);

        foreach (range(1, $users) as $i) {
            $this->state->create('user-'.$i, [
                'name' => 'John Doe',
            ]);
        }

        foreach (range(1, $users) as $i) {
            $this->state->merge();
        }

        $this->state->merge();

        $state = [
            'users' => [
                'title' => 'Users',
            ],
        ];

        $copy = &$state['users'];

        for ($i = 1; $i <= $users; $i++) {
            $copy = &$copy['user-'.$i];
            $copy = ['name' => 'John Doe'];
        }

        $this->assertEquals($state, $this->state->get());
        $this->assertTrue($this->state->current() === null);
    }

    /** @test */
    function it_can_push_arguments_into_a_key_store()
    {
        $this->state->push('email', 'john@example.com');
        $this->state->push('email', 'doe@example.com');

        $this->assertArrayHasKey('email', $this->state->current());
        $this->assertEquals([
            'john@example.com',
            'doe@example.com',
        ], $this->state->current()['email']);
    }
}
