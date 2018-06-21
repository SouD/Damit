<?php

use Domain\User\Role\Role;
use Domain\User\Role\RoleName;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->state(Role::class, RoleName::USER, function (Faker $faker) {
    return [
        'name' => RoleName::USER,
    ];
});

$factory->state(Role::class, RoleName::ADMIN, function (Faker $faker) {
    return [
        'name' => RoleName::ADMIN,
    ];
});
