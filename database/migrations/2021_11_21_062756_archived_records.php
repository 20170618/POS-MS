<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArchivedRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ArchivedRecords', function (Blueprint $table) {
            $table->unsignedBigInteger('SalesID');            
            $table->timestamps();

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
        //
        Schema::dropIfExists('ArchivedRecords');
    }
}
