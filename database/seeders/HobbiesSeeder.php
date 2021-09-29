<?php

use Illuminate\Database\Seeder;

class HobbiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('hobbies')->insert(array(
            array('name' => 'Sports','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Travelling','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Music','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Reading','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Social Activities','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
        ));
    }
}
