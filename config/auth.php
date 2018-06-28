<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'damit_token',
            'provider' => 'damit_users',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => Domain\User\User::class,
        ],
        'damit_users' => [
            'driver' => 'damit_users',
            'model' => Domain\User\User::class,
        ],
    ],
    'passwords' => [
        'users' => [
            'provider' => 'damit_users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],
];
