<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('countries')->insert(array(
            array('name' => 'India','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Australia','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Canada','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time'))
        ));
    }
}
