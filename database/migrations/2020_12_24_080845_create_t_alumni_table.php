<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_alumni', function (Blueprint $table) {
            $table->id('al_id')->autoIncrement();
            $table->string('al_firstname', 50);
            $table->string('al_middlename', 50)->nullable();
            $table->string('al_lastname', 50);
            $table->date('al_birthdate');
            $table->string('al_address', 225);
            $table->integer('al_contact_num');
            $table->string('al_student_num', 50);
            $table->unsignedBigInteger('al_course_id');
            $table->year('al_year_graduated');
            $table->string('al_honors_received', 50);
            $table->integer('al_employed_status');
            $table->unsignedBigInteger('al_work_id');

            $table->foreign('al_course_id')->references('course_id')->on('r_courses');
            $table->foreign('al_work_id')->references('alw_id')->on('t_alumni_work');
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
        Schema::dropIfExists('t_alumni');
    }
}
