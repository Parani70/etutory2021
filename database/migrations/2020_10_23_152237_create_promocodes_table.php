<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();
            $table->string('promocode');
            $table->string('description');
            $table->string('maxallowed');
            $table->string('maxunlimited');
            $table->string('startdate');
            $table->string('enddate');
            $table->string('promotype');
            $table->string('discount');
            $table->string('buynumber');
            $table->string('buyproduct');
            $table->string('buyproducttype');
            $table->string('getnumber');
            $table->string('getproduct');
            $table->string('getproductype');
            $table->string('examtype');
            $table->string('grade');
            $table->string('subject');
            $table->string('promotion');
            $table->string('status');
            $table->string('user');
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
        Schema::dropIfExists('promocodes');
    }
}
