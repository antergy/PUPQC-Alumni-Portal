<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRFormQuestionGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_form_question_group', function (Blueprint $table) {
            $table->id('fqg_id')->autoIncrement();
            $table->integer('fqg_sequence_no');
            $table->string('fqg_desc', 100);
            $table->unsignedBigInteger('fqg_form_id');

            $table->foreign('fqg_form_id')->references('form_id')->on('r_form');
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
        Schema::dropIfExists('r_form_question_group');
    }
}
