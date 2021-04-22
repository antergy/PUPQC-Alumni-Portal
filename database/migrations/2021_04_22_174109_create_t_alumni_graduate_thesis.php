<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniGraduateThesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_alumni_graduate_thesis', function (Blueprint $table) {
            $table->id('agt_id')->autoIncrement();
            $table->unsignedBigInteger('agt_alumni_id');
            $table->string('agt_title', 255);
            $table->string('agt_adviser', 100);

            $table->foreign('agt_alumni_id')->references('alumni_id')->on('t_alumni');
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
        Schema::dropIfExists('t_alumni_graduate_thesis');
    }
}
