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
            $table->unsignedBigInteger('PersonInCharge');
            $table->string('ModeOfPayment', 50);
            $table->double('AmountDue', 8, 2);
            $table->double('AmountPaid', 8, 2);
            $table->unsignedBigInteger('Debtor')->nullable();
            
            $table->timestamps();

            $table->foreign('PersonInCharge')->references('UserID')->on('users');
            $table->foreign('Debtor')->references('DebtorID')->on('debtor');
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
