<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(UserRoleSeeder::class);
        $this->call(AdminSeeder::class);

        if (App::environment('local')) {
            $this->call(UserSeeder::class);
        }
    }
}
