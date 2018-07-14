<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserRoleSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);

        if (App::environment('local')) {
            $this->call(UserSeeder::class);
        }
    }
}
