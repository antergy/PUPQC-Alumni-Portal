<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniGraduateJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_alumni_graduate_job', function (Blueprint $table) {
            $table->id('agj_id')->autoIncrement();
            $table->unsignedBigInteger('agj_alumni_id');
            $table->string('agj_curr_job_title', 100);
            $table->string('agj_prev_job_title', 100);

            $table->foreign('agj_alumni_id')->references('alumni_id')->on('t_alumni');
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
        Schema::dropIfExists('t_alumni_graduate_job');
    }
}
