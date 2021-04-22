<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRFormQuestionChoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_form_question_choices', function (Blueprint $table) {
            $table->id('fqc_id')->autoIncrement();
            $table->string('fqc_desc', 255);
            $table->unsignedBigInteger('fqc_fq_id');

            $table->foreign('fqc_fq_id')->references('fq_id')->on('r_form_questions');
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
        Schema::dropIfExists('r_form_question_choices');
    }
}
