<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRFormQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_form_questions', function (Blueprint $table) {
            $table->id('fq_id')->autoIncrement();
            $table->integer('fq_sequence_no');
            $table->string('fq_desc', 255);
            $table->unsignedBigInteger('fq_fqg_id');
            $table->unsignedBigInteger('fq_fqt_id');
            $table->integer('fq_active_status');

            $table->foreign('fq_fqg_id')->references('fqg_id')->on('r_form_question_group');
            $table->foreign('fq_fqt_id')->references('fqt_id')->on('r_form_question_type');
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
        Schema::dropIfExists('r_form_questions');
    }
}
