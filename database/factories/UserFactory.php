<?php

use Domain\User\Role\RoleName;
use Domain\User\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
    ];
});

$factory->state(User::class, RoleName::ADMIN, function (Faker $faker) {
    return [
        'email' => 'admin@' . config('app.domain', 'damit.test'),
    ];
});
