<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniCompanyProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_alumni_company_profile', function (Blueprint $table) {
            $table->id('acp_id')->autoIncrement();
            $table->unsignedBigInteger('acp_alumni_id');
            $table->longText('acp_company_name');
            $table->longText('acp_company_address');
            $table->string('acp_company_nature', 50);
            $table->unsignedBigInteger('acp_industry_id');
            $table->string('acp_industry_others', 100)->nullable();
            $table->string('acp_department_section', 100);
            $table->string('acp_work_area', 50);
            $table->string('acp_work_status', 50);

            $table->foreign('acp_alumni_id')->references('alumni_id')->on('t_alumni');
            $table->foreign('acp_industry_id')->references('industry_id')->on('r_industry');
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
        Schema::dropIfExists('t_alumni_company_profile');
    }
}
