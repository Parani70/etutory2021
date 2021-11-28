<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsMcqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_mcq', function (Blueprint $table) {
            $table->id();
            $table->string('qsid');
            $table->string('answerscount');
            $table->string('correctanswersacount');
            $table->string('answernumber');
            $table->string('answer');
            $table->string('imageupload');
            $table->string('imageurl');
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
        Schema::dropIfExists('questions_mcq');
    }
}
