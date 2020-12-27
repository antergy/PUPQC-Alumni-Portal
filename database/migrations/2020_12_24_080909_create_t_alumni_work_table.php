<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_alumni_work', function (Blueprint $table) {
            $table->id('alw_id')->autoIncrement();
            $table->unsignedBigInteger('alw_workfield_id');
            $table->year('alw_year_started');
            $table->integer('alw_years_rendered');

            $table->foreign('alw_workfield_id')->references('wf_id')->on('r_workfields');
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
        Schema::dropIfExists('t_alumni_work');
    }
}
