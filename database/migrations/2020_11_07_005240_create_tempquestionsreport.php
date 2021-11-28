<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempquestionsreport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempquestionsreport', function (Blueprint $table) {
            $table->id();
            $table->string('reportid');
            $table->string('mediumcount');
            $table->string('medium');
            $table->string('grade');
            $table->string('subject');
            $table->string('qstype');
            $table->string('category');
            $table->string('subcategory');
            $table->string('approvedquestions');
            $table->string('notapprovedquestions');
            $table->string('entrytype');
            $table->string('user');
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
        Schema::dropIfExists('tempquestionsreport');
    }
}
