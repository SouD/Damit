<?php

return [
    'type' => [
        'attribute' => [
            'description' => 'En användare.',
        ],
        'field' => [
            'email' => [
                'description' => 'Användarens e-postadress.',
            ],
            'logins' => [
                'description' => 'Användarens antal inloggningar.',
            ],
            'last_login_at' => [
                'description' => 'Användarens loggade senast in detta datum.',
            ],
            'created_at' => [
                'description' => 'Användaren skapades detta datum.',
            ],
            'updated_at' => [
                'description' => 'Användaren uppdaterades detta datum.',
            ],
            'is_admin' => [
                'description' => 'Användaren är administratör eller ej.',
            ],
        ],
    ],
    'auth_token' => [
        'type' => [
            'attribute' => [
                'description' => 'En användares inloggningsnyckel.',
            ],
            'field' => [
                'token' => [
                    'description' => 'Inloggningsnyckel.',
                ],
                'expires_at' => [
                    'description' => 'Inloggningsnyckelen löper ut detta datum.',
                ],
                'created_at' => [
                    'description' => 'Inloggningsnyckelen skapades detta datum.',
                ],
                'updated_at' => [
                    'description' => 'Inloggningsnyckelen uppdaterades detta datum.',
                ],
            ],
        ],
    ],
];
