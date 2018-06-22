<?php

use Domain\User\UserQuery;
use Domain\User\UserType;

return [
    'prefix' => 'graphql',
    'routes' => [
        'query' => 'query/{graphql_schema?}',
        'mutation' => 'mutation/{graphql_schema?}',
    ],
    // 'routes' => '{graphql_schema?}',
    'controllers' => [
        'query' => \Rebing\GraphQL\GraphQLController::class . '@query',
        'mutation' => \Rebing\GraphQL\GraphQLController::class . '@mutation',
    ],
    // 'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',
    'middleware' => ['api'],
    'default_schema' => 'default',

    // The schemas for query and/or mutation. It expects an array of schemas to provide
    // both the 'query' fields and the 'mutation' fields.
    //
    // You can also provide a middleware that will only apply to the given schema
    //
    // Example:
    //
    //  'schema' => 'default',
    //
    //  'schemas' => [
    //      'default' => [
    //          'query' => [
    //              'users' => 'App\GraphQL\Query\UsersQuery',
    //          ],
    //          'mutation' => [
    //
    //          ],
    //      ],
    //      'user' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\ProfileQuery',
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //      'user/me' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\MyProfileQuery',
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //  ],
    //
    'schemas' => [
        'default' => [
            'query' => [
                'user' => UserQuery::class,
            ],
            'mutation' => [],
            'middleware' => [],
        ],
        'user' => [
            'query' => [
                'user' => UserQuery::class,
            ],
            'mutation' => [],
            'middleware' => [],
        ],
    ],
    'types' => [
        'user' => UserType::class,
    ],

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => [],
    // ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key' => 'params',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://github.com/webonyx/graphql-php#security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false,
    ],
];
