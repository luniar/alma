<?php

return [
    [
        'key' => Luniar\Alma\Tests\Stubs\Concepts\EventConcept::class,
        'type' => 'concept',
        'value' => [
            [
                'key' => Luniar\Alma\Tests\Stubs\Concepts\Event\EventStartFragment::class,
                'type' => 'fragment',
                'value' => 'hello {',
                'matches' => [
                    'hello {',
                    'hello',
                    'eventName' => 'hello',
                ],
            ],

            [
                'key' => Luniar\Alma\Tests\Stubs\Concepts\Shared\SayFragment::class,
                'type' => 'fragment',
                'value' => '@say "Hello"',
                'matches' => [
                    '@say "Hello"',
                    'Hello',
                    'text' => 'Hello',
                ],
            ],
            [
                'key' => Luniar\Alma\Tests\Stubs\Concepts\Event\EventFinishFragment::class,
                'type' => 'fragment',
                'value' => '}',
                'matches' => [
                    '}',
                ],
            ],

        ],
    ],

    [
        'key' => Luniar\Alma\Tests\Stubs\Concepts\EventConcept::class,
        'type' => 'concept',
        'value' => [
            [
                'key' => Luniar\Alma\Tests\Stubs\Concepts\Event\EventStartFragment::class,
                'type' => 'fragment',
                'value' => 'world {',
                'matches' => [
                    'world {',
                    'world',
                    'eventName' => 'world',
                ],
            ],

            [
                'key' => Luniar\Alma\Tests\Stubs\Concepts\Shared\SayFragment::class,
                'type' => 'fragment',
                'value' => '@say "World."',
                'matches' => [
                    '@say "World."',
                    'World.',
                    'text' => 'World.',
                ],

            ],

            [
                'key' => Luniar\Alma\Tests\Stubs\Concepts\Event\EventFinishFragment::class,
                'type' => 'fragment',
                'value' => '}',
                'matches' => [
                    '}',
                ],
            ],
        ],
    ],

    [
        'key' => Luniar\Alma\Tests\Stubs\Concepts\Listener\ListenFragment::class,
        'type' => 'fragment',
        'value' => '@listen hello',
        'matches' => [
            '@listen hello',
            'hello',
        ],
    ],

    [
        'key' => Luniar\Alma\Tests\Stubs\Concepts\Listener\ListenFragment::class,
        'type' => 'fragment',
        'value' => '@listen world',
        'matches' => [
            '@listen world',
            'world',
        ],
    ],
];
