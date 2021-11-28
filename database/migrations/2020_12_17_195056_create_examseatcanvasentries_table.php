<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamseatcanvasentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examseatcanvasentries', function (Blueprint $table) {
            $table->id();
            $table->string('examseatid');
            $table->string('qscode');
            $table->string('qstype');
            $table->string('canvas');
            $table->string('position');
            $table->string('status');
            $table->string('userid');
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
        Schema::dropIfExists('examseatcanvasentries');
    }
}
