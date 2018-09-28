<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);         
            $table->string('email', 50)->unique();
            $table->string('rif', 10)->unique();
            $table->string('password');
            $table->string('description', 200);
            $table->string('country', 50);
            $table->string('state', 50);
            $table->string('city', 50);
            $table->string('address', 200);
            $table->integer('zip_code');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('phone_number', 20);
            $table->string('website', 150);
            $table->string('api_token', 100)->unique()->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
