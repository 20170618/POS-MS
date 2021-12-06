<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eloads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ProductID');
            $table->double('LoadAmount',8,2);
            $table->timestamps();

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
        Schema::dropIfExists('eloads');
    }
}