<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniUnemployedReason extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_alumni_unemployed_reason', function (Blueprint $table) {
            $table->id('aur_id')->autoIncrement();
            $table->unsignedBigInteger('aur_alumni_id');
            $table->unsignedBigInteger('aur_unemploy_reason');
            $table->longText('aur_other_desc')->nullable();

            $table->foreign('aur_alumni_id')->references('al_id')->on('t_alumni');
            $table->foreign('aur_unemploy_reason')->references('ur_id')->on('r_unemployment_reason');
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
        Schema::dropIfExists('t_alumni_unemployed_reason');
    }
}
