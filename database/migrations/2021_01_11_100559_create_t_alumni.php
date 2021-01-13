<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumni extends Migration
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
            $table->unsignedBigInteger('al_acc_id');
            $table->longText('al_firstname');
            $table->longText('al_middlename')->nullable();
            $table->longText('al_lastname');
            $table->longText('al_birthdate');
            $table->longText('al_address');
            $table->longText('al_email');
            $table->longText('al_tel_num')->nullable();
            $table->longText('al_mobile_num');
            $table->longText('al_student_num')->nullable();
            $table->integer('al_civil_status');
            $table->unsignedBigInteger('al_course_id');
            $table->year('al_year_graduated');
            $table->unsignedBigInteger('al_honors_received');
            $table->unsignedBigInteger('al_educ_attainment');
            $table->longText('al_educ_attainment_others')->nullable();
            $table->unsignedBigInteger('al_prof_exam_passed');
            $table->longText('al_prof_exam_passed_others')->nullable();
            $table->integer('al_employment_status');
            $table->longText('al_first_job_desc')->nullable();
            $table->unsignedBigInteger('al_first_job_discover')->nullable();
            $table->unsignedBigInteger('al_first_job_timeframe')->nullable();
            $table->integer('al_work_place')->nullable();
            $table->longText('al_work_place_intl')->nullable();
            $table->unsignedBigInteger('al_self_employ_salary')->nullable();

            $table->foreign('al_acc_id')->references('acc_id')->on('t_accounts');
            $table->foreign('al_course_id')->references('course_id')->on('r_courses');
            $table->foreign('al_honors_received')->references('honor_id')->on('r_honors_received');
            $table->foreign('al_educ_attainment')->references('educ_attain_id')->on('r_educational_attainment');
            $table->foreign('al_prof_exam_passed')->references('profex_id')->on('r_professional_exams');
            $table->foreign('al_first_job_discover')->references('fjd_id')->on('r_first_job_discover');
            $table->foreign('al_first_job_timeframe')->references('fjtf_id')->on('r_first_job_timeframe');
            $table->foreign('al_self_employ_salary')->references('se_salary_id')->on('r_self_employed_salary');
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
