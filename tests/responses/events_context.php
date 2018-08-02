<?php

return [
    'events' => [
        'hello' => [
            'event' => 'hello',
            'actions' => [
                [
                    'class' => 'SayAction',
                    'message' => 'Hello',
                ],
            ],
        ],

        'world' => [
            'event' => 'world',
            'actions' => [
                [
                    'class' => 'SayAction',
                    'message' => 'World.',
                ],
            ],
        ],
    ],

    'listeners' => [
        'hello' => ['hello'],
        'world' => ['world'],
    ],
];
