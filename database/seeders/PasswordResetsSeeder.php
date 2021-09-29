<?php

use App\PasswordReset;
use Illuminate\Database\Seeder;

class PasswordResetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PasswordReset::class, 10)->create();
    }
}
