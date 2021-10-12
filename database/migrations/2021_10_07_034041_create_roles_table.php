<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->index()->comment('AUTO_INCREMENT');
            $table->string('name',255)->nullable();
            $table->string('guard_name',255)->nullable();
            $table->string('landing_page',255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_by')->nullable()->comment('Users table ID');
            $table->unsignedInteger('updated_by')->nullable()->comment('Users table ID');
        });

        DB::table('roles')->insert(array(
            array('name' => 'Administrator','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Manager','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Supervisor','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Dealer','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
            array('name' => 'Employee','created_at' => config('constants.calender.date_time'),'updated_at' => config('constants.calender.date_time')),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
