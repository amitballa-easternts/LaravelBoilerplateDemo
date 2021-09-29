<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index()->comment('AUTO_INCREMENTS');
            $table->string('name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('password',255)->nullable();
            $table->string('mobile_no',255)->nullable();
            $table->unsignedInteger('role_id')->index()->nullable()->comment('roles table id');;
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('profile',255)->nullable();
            $table->enum('gender',['0', '1'])->nullable()->index()->comment('0 - Female, 1 - Male');
            $table->date('dob')->nullable();
            $table->unsignedInteger('country_id')->index()->nullable()->comment('countries table id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedInteger('state_id')->index()->nullable()->comment('states table id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->unsignedInteger('city_id')->index()->nullable()->comment('cities table id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('address',500)->nullable();
            $table->enum('status', ['0', '1'])->index()->comment('0 - Inactive, 1 - Active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token',255)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
