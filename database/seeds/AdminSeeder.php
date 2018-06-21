<?php

use Domain\User\Role\Role;
use Domain\User\Role\RoleName;
use Domain\User\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $role = Role::where('name', RoleName::ADMIN)
            ->firstOrFail();
        factory(User::class, 1)->states(RoleName::ADMIN)
            ->create()
            ->each(function (User $user) use ($role) {
                $user->roles()
                    ->attach($role);
            });
    }
}
