<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniWorkExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_alumni_work_experience', function (Blueprint $table) {
            $table->id('awe_id')->autoIncrement();
            $table->unsignedBigInteger('awe_alumni_id');
            $table->longText('awe_company_name');
            $table->longText('awe_company_address');
            $table->integer('awe_company_nature');
            $table->longText('awe_company_nature_others')->nullable();
            $table->unsignedBigInteger('awe_industry_nature');
            $table->longText('awe_industry_nature_others')->nullable();

            $table->foreign('awe_alumni_id')->references('al_id')->on('t_alumni');
            $table->foreign('awe_industry_nature')->references('industry_id')->on('r_industry');
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
        Schema::dropIfExists('t_alumni_work_experience');
    }
}
