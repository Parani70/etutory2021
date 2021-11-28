<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocodetransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocodetrans', function (Blueprint $table) {
            $table->id();
            $table->string('promocode');
            $table->string('promocodetype');
            $table->string('studentid');
            $table->string('studentname');
            $table->string('transactionid');
            $table->string('productid');
            $table->string('productname');
            $table->string('producttype');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promocodetrans');
    }
}
