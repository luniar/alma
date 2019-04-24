<?php

return [
    [
        'key' => Luniar\Alma\Tests\Stubs\Concepts\Event::class,
        'value' => [
            [
                'key' => Luniar\Alma\Tests\Stubs\Concepts\Say::class,
                'value' => '@say "Hello"',
                'matches' => [
                    '@say "Hello"',
                    'Hello',
                    'text' => 'Hello',
                ],
            ],
        ],
        'matches' => [
            'hello {',
            'hello',
            'eventName' => 'hello',
        ],
    ],

    [
        'key' => Luniar\Alma\Tests\Stubs\Concepts\Event::class,
        'value' => [
            [
                'key' => Luniar\Alma\Tests\Stubs\Concepts\Say::class,
                'value' => '@say "World."',
                'matches' => [
                    '@say "World."',
                    'World.',
                    'text' => 'World.',
                ],
            ],
        ],
        'matches' => [
            'world {',
            'world',
            'eventName' => 'world',
        ],
    ],

    [
        'key' => Luniar\Alma\Tests\Stubs\Concepts\Listen::class,
        'value' => '@listen hello',
        'matches' => [
            '@listen hello',
            'hello',
        ],
    ],

    [
        'key' => Luniar\Alma\Tests\Stubs\Concepts\Listen::class,
        'value' => '@listen world',
        'matches' => [
            '@listen world',
            'world',
        ],
    ],
];
