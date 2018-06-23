<?php

return [
    'type' => [
        'attribute' => [
            'description' => 'A user.',
        ],
        'field' => [
            'email' => [
                'description' => 'User email address.',
            ],
            'createdAt' => [
                'description' => 'User created at.',
            ],
            'updatedAt' => [
                'description' => 'User updated at.',
            ],
            'isAdmin' => [
                'description' => 'User is admin or not.',
            ],
        ],
    ],
    'auth_token' => [
        'type' => [
            'attribute' => [
                'description' => 'A user auth token.',
            ],
            'field' => [
                'token' => [
                    'description' => 'Auth token token.',
                ],
                'expiresAt' => [
                    'description' => 'Auth token expires at.',
                ],
                'createdAt' => [
                    'description' => 'Auth token created at.',
                ],
                'updatedAt' => [
                    'description' => 'Auth token updated at.',
                ],
            ],
        ],
    ],
];
