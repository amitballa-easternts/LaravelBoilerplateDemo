<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cities')->insert(array(
            array('state_id'=>'1','name' => 'Surat','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('state_id'=>'1','name' => 'Baroda','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('state_id'=>'2','name' => 'Jaipur','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time'))
        ));
    }
}
