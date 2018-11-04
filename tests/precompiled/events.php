<?php

return [
    [
        'key' => Luniar\Alma\Tests\Stubs\Groups\EventGroup::class,
        'value' => [
            [
                'key' => Luniar\Alma\Tests\Stubs\Groups\Event\EventStartToken::class,
                'value' => 'hello {',
                'args' => [],
                'matches' => [
                    'hello {',
                    'hello',
                ],
            ],

            [
                'key' => Luniar\Alma\Tests\Stubs\Groups\Shared\SayToken::class,
                'value' => '@say "Hello"',
                'args' => [],
                'matches' => [
                    '@say "Hello"',
                    'Hello',
                ],
            ],
            [
                'key' => Luniar\Alma\Tests\Stubs\Groups\Event\EventFinishToken::class,
                'value' => '}',
                'args' => [],
                'matches' => [
                    '}',
                ],
            ],

        ],
        'args' => [],
    ],

    [
        'key' => Luniar\Alma\Tests\Stubs\Groups\EventGroup::class,
        'value' => [
            [
                'key' => Luniar\Alma\Tests\Stubs\Groups\Event\EventStartToken::class,
                'value' => 'world {',
                'args' => [],
                'matches' => [
                    'world {',
                    'world',
                ],
            ],

            [
                'key' => Luniar\Alma\Tests\Stubs\Groups\Shared\SayToken::class,
                'value' => '@say "World."',
                'args' => [],
                'matches' => [
                    '@say "World."',
                    'World.',
                ],

            ],

            [
                'key' => Luniar\Alma\Tests\Stubs\Groups\Event\EventFinishToken::class,
                'value' => '}',
                'args' => [],
                'matches' => [
                    '}',
                ],
            ],

        ],
        'args' => [],
    ],

    [
        'key' => Luniar\Alma\Tests\Stubs\Groups\Listener\ListenToken::class,
        'value' => '@listen hello',
        'args' => [],
        'matches' => [
            '@listen hello',
            'hello',
        ],

    ],

    [
        'key' => Luniar\Alma\Tests\Stubs\Groups\Listener\ListenToken::class,
        'value' => '@listen world',
        'args' => [],
        'matches' => [
            '@listen world',
            'world',
        ],

    ],
];
