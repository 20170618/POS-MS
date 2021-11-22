<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SalesDetails', function (Blueprint $table) {
            $table->unsignedBigInteger('SalesID');
            $table->unsignedBigInteger('ProductID');
            $table->integer('Quantity');
            $table->integer('LoadAmount')->nullable();
            $table->timestamps();

            $table->foreign('SalesID')->references('SalesID')->on('Sales');
            $table->foreign('ProductID')->references('ProductID')->on('Product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SalesDetails');
    }
}
