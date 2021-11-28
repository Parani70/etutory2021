<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapertemplatesdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papertemplatesdata', function (Blueprint $table) {
            $table->id();
            $table->string('templateid');
            $table->string('categoryid');
            $table->string('categoryname');
            $table->string('subcategoryid');
            $table->string('subcategoryname');
            $table->string('levelid');
            $table->string('levelname');
            $table->string('qstype');
            $table->string('qscount');
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
        Schema::dropIfExists('papertemplatesdata');
    }
}
