<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name', 150);
            $table->string('last_name', 150);           
            $table->string('email', 50)->unique();
            $table->string('dni', 10)->unique();
            $table->string('password');
            $table->string('country', 50);
            $table->string('state', 50);
            $table->string('city', 50);
            $table->string('address', 200);
            $table->integer('zip_code');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('phone_number', 20);
            $table->rememberToken();
            $table->timestamps();
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
