<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRFormAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_form_answers', function (Blueprint $table) {
            $table->id('fa_id')->autoIncrement();
            $table->longtext('fa_answer');
            $table->unsignedBigInteger('fa_fq_id');
            $table->unsignedBigInteger('fa_acc_id');

            $table->foreign('fa_fq_id')->references('fq_id')->on('r_form_questions');
            $table->foreign('fa_acc_id')->references('acc_id')->on('t_accounts');
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
        Schema::dropIfExists('r_form_answers');
    }
}
