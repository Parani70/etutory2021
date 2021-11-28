<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsMatchingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_matching', function (Blueprint $table) {
            $table->id();
            $table->string('qsid');
            $table->string('answerscount');
            $table->string('answernumber');
            $table->string('answer');
            $table->string('side');
            $table->string('matchinganswer');
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
        Schema::dropIfExists('questions_matching');
    }
}
