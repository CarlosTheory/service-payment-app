<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->decimal('price');
            $table->decimal('iva');
            $table->decimal('percentage');
            $table->timestamps();
            $table->string('state', 10);
            $table->string('description', 200);
            $table->unsignedInteger('business_id')->nullable();
            $table->foreign('business_id')
                  ->references('id')
                  ->on('businesses')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unsignedInteger('type_id')->nullable();
            $table->foreign('type_id')
                    ->references('id')
                    ->on('product_types')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                  });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
