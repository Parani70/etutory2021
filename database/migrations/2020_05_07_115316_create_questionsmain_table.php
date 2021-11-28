<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsmainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionsmain', function (Blueprint $table) {
            $table->id();
            $table->string('qstype');
            $table->string('examtypeid');
            $table->string('examtypename');
            $table->string('categoryid');
            $table->string('categoryname');
            $table->string('subcategoryid');
            $table->string('subcategoryname');
            $table->string('subjectid');
            $table->string('subjectname');
            $table->string('gradeid');
            $table->string('gradename');
            $table->string('levelid');
            $table->string('levelname');
            $table->string('questionheader');
            $table->string('imageupload');
            $table->string('imageurl');
            $table->string('imageposition');
            $table->string('marksallocated');
            $table->string('status');
            $table->string('enteredbyid');
            $table->string('enteredbyname');
            $table->string('approvedbyid');
            $table->string('approvedbyname');
            $table->string('deaccuracy');
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
        Schema::dropIfExists('questionsmain');
    }
}

