<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentpromotransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentpromotrans', function (Blueprint $table) {
            $table->id();
            $table->string('studentid');
            $table->string('studentname');
            $table->string('email');
            $table->string('promotype');
            $table->string('promoid');
            $table->string('promoname');
            $table->string('papercount');
            $table->string('gradeid');
            $table->string('gradename');
            $table->string('subjectid');
            $table->string('subjectname');
            $table->string('templateid');
            $table->string('templatename');
            $table->string('status');
            $table->string('paystatus');
            $table->string('paymethod');
            $table->string('payimage');
            $table->string('price');
            $table->string('approvedbyid');    
            $table->string('approvedbyname');
            $table->string('approvedbydate');
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
        Schema::dropIfExists('studentpromotrans');
    }
}
