<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRWorkfieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('r_workfields', function (Blueprint $table) {
            $table->id('wf_id')->autoIncrement();
            $table->string('wf_desc', 225);
            $table->unsignedBigInteger('wf_course_id')->unsigned();
            $table->foreign('wf_course_id')->references('course_id')->on('r_courses');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_workfields');
    }
}
