<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sales', function (Blueprint $table) {
            $table->id('SalesID');
            $table->unsignedBigInteger('PersonInChargeID')->nullable();
            $table->string('PersonInCharge', 50);
            $table->string('ModeOfPayment', 6);
            $table->timestamps();

            $table->foreign('PersonInChargeID')->references('UserID')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Sales');
    }
}
