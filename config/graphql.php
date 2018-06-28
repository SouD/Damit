<?php

use Domain\User\Auth\AuthTokenType;
use Domain\User\Query\UserQuery;
use Domain\User\UserType;
use Infrastructure\Auth\Mutation\ForgotPasswordMutation;
use Infrastructure\Auth\Mutation\LoginMutation;
use Infrastructure\Auth\Mutation\LogoutMutation;
use Rebing\GraphQL\GraphQLController;

return [
    'prefix' => 'graphql',
    'routes' => '{graphql_schema?}',
    'controllers' => GraphQLController::class . '@query',
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
            'query' => [],
            'mutation' => [
                'login' => LoginMutation::class,
            ],
            'middleware' => [],
        ],
        'auth' => [
            'query' => [],
            'mutation' => [
                'login' => LoginMutation::class,
                'logout' => LogoutMutation::class, // Auth required.
                'forgotPassword' => ForgotPasswordMutation::class,
            ],
            'middleware' => [],
        ],
        'user' => [
            'query' => [
                'User' => UserQuery::class,
            ],
            'mutation' => [],
            'middleware' => [],
        ],
    ],
    'types' => [
        'User' => UserType::class,
        'AuthToken' => AuthTokenType::class,
    ],

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => [],
    // ],
    // 'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'error_formatter' => [\Damit\Exceptions\Handler::class, 'formatError'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key' => 'variables',

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
