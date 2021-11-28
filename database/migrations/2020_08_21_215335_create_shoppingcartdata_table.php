<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingcartdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppingcartdata', function (Blueprint $table) {
            $table->id();
            $table->string('cartid');
            $table->string('userid');
            $table->string('productid');
            $table->string('productname');
            $table->string('producttype');
            $table->string('price');
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
        Schema::dropIfExists('shoppingcartdata');
    }
}
