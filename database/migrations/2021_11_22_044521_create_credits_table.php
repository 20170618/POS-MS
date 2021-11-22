<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->unsignedBigInteger('SalesID');
            $table->dateTime('BalancePayDate')->nullable();
            $table->string('Debtor');
            $table->double('Balance', 8, 2);
            $table->double('InitialPayment', 8, 2);
            
            $table->foreign('SalesID')->references('SalesID')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credits');
    }
}
