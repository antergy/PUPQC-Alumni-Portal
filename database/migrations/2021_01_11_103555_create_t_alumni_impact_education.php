<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniImpactEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_alumni_impact_education', function (Blueprint $table) {
            $table->id('aled_id')->autoIncrement();
            $table->unsignedBigInteger('aled_alumni_id');
            $table->unsignedBigInteger('aled_impact_education');
            $table->integer('aled_rating');

            $table->foreign('aled_alumni_id')->references('al_id')->on('t_alumni');
            $table->foreign('aled_impact_education')->references('ioe_id')->on('r_impact_of_education');
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
        Schema::dropIfExists('t_alumni_impact_education');
    }
}
