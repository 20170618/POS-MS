<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Product', function (Blueprint $table) {
            $table->id('ProductID');
            $table->string('ProductName', 50);
            $table->unsignedBigInteger('Category');
            $table->double('Price', 8, 2);
            $table->integer('Stock');
            $table->string('Description', 255);
            $table->timestamps();

            $table->foreign('Category')->references('CategoryID')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Product');
    }
}
