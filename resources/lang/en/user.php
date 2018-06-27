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
            'logins' => [
                'description' => 'User logins.',
            ],
            'last_login_at' => [
                'description' => 'User last login at.',
            ],
            'created_at' => [
                'description' => 'User created at.',
            ],
            'updated_at' => [
                'description' => 'User updated at.',
            ],
            'is_admin' => [
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
                'expires_at' => [
                    'description' => 'Auth token expires at.',
                ],
                'created_at' => [
                    'description' => 'Auth token created at.',
                ],
                'updated_at' => [
                    'description' => 'Auth token updated at.',
                ],
            ],
        ],
    ],
];
