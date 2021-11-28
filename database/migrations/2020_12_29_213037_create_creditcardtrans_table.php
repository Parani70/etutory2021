<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditcardtransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditcardtrans', function (Blueprint $table) {
            $table->id();
            $table->string('ordernumber');
            $table->string('studenttransid');
            $table->string('productid');
            $table->string('gwrefnumber');
            $table->string('gwdate');
            $table->string('gwstatus');
            $table->string('gwcomment');
            $table->string('gwgateway');     
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
        Schema::dropIfExists('creditcardtrans');
    }
}
