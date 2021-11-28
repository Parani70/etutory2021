<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentfreeproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentfreeproducts', function (Blueprint $table) {
            $table->id();
            $table->string('studentid');
            $table->string('maintransid');
            $table->string('promocode');
            $table->string('entrycount');
            $table->string('productid');
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
        Schema::dropIfExists('studentfreeproducts');
    }
}
