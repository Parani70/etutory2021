<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapertemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papertemplates', function (Blueprint $table) {
            $table->id();
            $table->string('coursename');
            $table->string('subjectid');
            $table->string('subjectname');
            $table->string('gradeid');
            $table->string('gradename');
            $table->string('numberofquestion');
            $table->string('durationhour');
            $table->string('durationminute');
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
        Schema::dropIfExists('papertemplates');
    }
}
