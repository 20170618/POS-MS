<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange', function (Blueprint $table) {
            $table->unsignedBigInteger('SalesID');
            $table->unsignedBigInteger('OldProductID');
            $table->unsignedBigInteger('NewProductID');
            $table->integer('Quantity');
            $table->string('Status', 8);
            $table->string('Reason', 50);
            $table->timestamps();

            $table->foreign('SalesID')->references('SalesID')->on('sales');
            $table->foreign('OldProductID')->references('ProductID')->on('product');
            $table->foreign('NewProductID')->references('ProductID')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange');
    }
}
