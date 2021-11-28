<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudenttransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studenttransactions', function (Blueprint $table) {
            $table->id();
            $table->string('studentid');
            $table->string('studentname');
            $table->string('email');
            $table->string('type');
            $table->string('productid');
            $table->string('productname');
            $table->string('grade');
            $table->string('subject');
            $table->string('price');
            $table->string('paymethod');
            $table->string('paystatus');
            $table->string('approvedbyid');
            $table->string('approvedbyname');
            $table->string('approvedbydate');
            $table->string('status');
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
        Schema::dropIfExists('studenttransactions');
    }
}
