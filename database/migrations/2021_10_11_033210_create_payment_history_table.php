<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PaymentHistory', function (Blueprint $table) {
            $table->id('PaymentID');
            $table->unsignedBigInteger('SalesID');
            $table->unsignedBigInteger('PaidBy');
            $table->date('PaymentDate');
            $table->double('AmountPaid', 8, 2);
            $table->timestamps();

            $table->foreign('SalesID')->references('SalesID')->on('Sales');
            $table->foreign('PaidBy')->references('DebtorID')->on('Debtor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PaymentHistory');
    }
}
