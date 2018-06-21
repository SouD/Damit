<?php

use Domain\User\Role\Role;
use Domain\User\Role\RoleName;
use Domain\User\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $role = Role::where('name', RoleName::USER)
            ->firstOrFail();
        factory(User::class, 10)->create()
            ->each(function (User $user) use ($role) {
                $user->roles()
                    ->attach($role);
            });
    }
}
