<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniCompetencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_alumni_competencies', function (Blueprint $table) {
            $table->id('alcom_id')->autoIncrement();
            $table->unsignedBigInteger('alcom_alumni_id');
            $table->unsignedBigInteger('alcom_competency');
            $table->integer('alcom_acquire_level');
            $table->integer('alcom_relevant_level');

            $table->foreign('alcom_alumni_id')->references('al_id')->on('t_alumni');
            $table->foreign('alcom_competency')->references('competency_id')->on('r_competencies');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
        Schema::dropIfExists('t_alumni_competencies');
    }
}
