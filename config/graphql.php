<?php

use Domain\Category\CategoryType;
use Domain\Category\Query\CategoryQuery;
use Domain\Country\CountryType;
use Domain\Country\Query\CountriesQuery;
use Domain\Currency\CurrencyType;
use Domain\Currency\Query\CurrenciesQuery;
use Domain\User\Query\CurrentUserQuery;
use Domain\User\UserType;
use Infrastructure\Auth\Mutation\ForgotPasswordMutation;
use Infrastructure\Auth\Mutation\LoginMutation;
use Infrastructure\Auth\Mutation\LogoutMutation;
use Infrastructure\Auth\Mutation\ResetPasswordMutation;
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
                'resetPassword' => ResetPasswordMutation::class,
            ],
            'middleware' => [],
        ],
        'category' => [
            'query' => [
                'Category' => CategoryQuery::class,
            ],
            'mutation' => [],
            'middleware' => [],
        ],
        'country' => [
            'query' => [
                'Countries' => CountriesQuery::class,
            ],
            'mutation' => [],
            'middleware' => [],
        ],
        'currency' => [
            'query' => [
                'Currencies' => CurrenciesQuery::class,
            ],
            'mutation' => [],
            'middleware' => [],
        ],
        'user' => [
            'query' => [
                'CurrentUser' => CurrentUserQuery::class,
            ],
            'mutation' => [],
            'middleware' => ['auth:api'],
        ],
    ],
    'types' => [
        'Category' => CategoryType::class,
        'Country' => CountryType::class,
        'Currency' => CurrencyType::class,
        'User' => UserType::class,
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
