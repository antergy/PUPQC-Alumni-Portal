<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_form', function (Blueprint $table) {
            $table->id('form_id')->autoIncrement();
            $table->string('form_desc', 100);
            $table->unsignedBigInteger('form_degree_id');
            $table->unsignedBigInteger('form_course_id')->nullable();
            $table->integer('form_active_status');

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
        Schema::dropIfExists('r_form');
    }
}
