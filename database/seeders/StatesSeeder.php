<?php

use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('states')->insert(array(
            array('country_id'=>'1','name' => 'Gujarat','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('country_id'=>'1','name' => 'Rajasthan','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('country_id'=>'2','name' => 'Sydney','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time'))
        ));
    }
}
