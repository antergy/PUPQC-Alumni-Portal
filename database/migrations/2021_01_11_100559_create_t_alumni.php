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
            $table->id('alumni_id')->autoIncrement();
            $table->unsignedBigInteger('alumni_acc_id');
            $table->longText('alumni_firstname');
            $table->longText('alumni_middlename')->nullable();
            $table->longText('alumni_lastname');
            $table->string('alumni_birthdate', 50);
            $table->string('alumni_gender', 10);
            $table->longText('alumni_address');
            $table->longText('alumni_email');
            $table->longText('alumni_tel_num')->nullable();
            $table->longText('alumni_mobile_num');
            $table->longText('alumni_student_num')->nullable();
            $table->integer('alumni_civil_status');
            $table->unsignedBigInteger('alumni_course_id');
            $table->year('alumni_year_graduated')->nullable();
            $table->string('alumni_year_grad_complete_program', 10)->nullable();
            $table->integer('alumni_age_graduate_enrolled')->nullable();
            $table->longText('alumni_employ_status')->nullable();
            $table->longtext('alumni_unemploy_status')->nullable();

            $table->foreign('alumni_acc_id')->references('acc_id')->on('t_accounts');
            $table->foreign('alumni_course_id')->references('course_id')->on('r_courses');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
