<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniJobLevelExp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_alumni_job_level_exp', function (Blueprint $table) {
            $table->id('ajle_id')->autoIncrement();
            $table->unsignedBigInteger('ajle_alumni_id');
            $table->unsignedBigInteger('ajle_job_level_id');
            $table->integer('ajle_occurence');

            $table->foreign('ajle_alumni_id')->references('al_id')->on('t_alumni');
            $table->foreign('ajle_job_level_id')->references('jlc_id')->on('r_job_level_classification');
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
        Schema::dropIfExists('t_alumni_job_level_exp');
    }
}
