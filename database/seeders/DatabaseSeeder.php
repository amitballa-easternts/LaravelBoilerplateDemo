<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersSeeder::class);
        //$this->call(PasswordResetsSeeder::class);
        //$this->call(RolesSeeder::class);
        //$this->call(PermissionsSeeder::class);
        //$this->call(PermissionRolesSeeder::class);
        //$this->call(CountriesSeeder::class);
        $this->call(StatesSeeder::class);
        //$this->call(CitiesSeeder::class);
        //$this->call(HobbiesSeeder::class);
    }
}
