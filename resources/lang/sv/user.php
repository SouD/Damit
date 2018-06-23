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
            'createdAt' => [
                'description' => 'Användaren skapades detta datum.',
            ],
            'updatedAt' => [
                'description' => 'Användaren uppdaterades detta datum.',
            ],
            'isAdmin' => [
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
                'expiresAt' => [
                    'description' => 'Inloggningsnyckelen löper ut detta datum.',
                ],
                'createdAt' => [
                    'description' => 'Inloggningsnyckelen skapades detta datum.',
                ],
                'updatedAt' => [
                    'description' => 'Inloggningsnyckelen uppdaterades detta datum.',
                ],
            ],
        ],
    ],
];
