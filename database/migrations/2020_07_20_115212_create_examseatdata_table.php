<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamseatdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examseatdata', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('examseatid');
            $table->string('questiontype');  
            $table->string('questionid');
            $table->string('answer');
            $table->string('correct');
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
        Schema::dropIfExists('examseatdata');
    }
}
