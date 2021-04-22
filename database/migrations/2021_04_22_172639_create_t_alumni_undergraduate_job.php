<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniUndergraduateJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_alumni_undergraduate_job', function (Blueprint $table) {
            $table->id('auj_id')->autoIncrement();
            $table->unsignedBigInteger('auj_alumni_id');
            $table->string('auj_first_job', 100);
            $table->string('auj_first_job_discover', 100);
            $table->string('auj_first_job_timeframe', 100);
            $table->string('auj_first_job_level_position', 100);
            $table->string('auj_curr_job_level_position', 100);
            $table->string('auj_self_employ_salary', 50);

            $table->foreign('auj_alumni_id')->references('alumni_id')->on('t_alumni');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_alumni_undergraduate_job');
    }
}
