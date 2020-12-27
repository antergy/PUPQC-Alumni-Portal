<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_posts', function (Blueprint $table) {
            $table->id('p_id')->autoIncrement();
            $table->string('p_title', 225);
            $table->longText('p_desc');
            $table->string('p_picture', 225)->nullable();
            $table->unsignedBigInteger('p_acc_id');
            $table->unsignedBigInteger('p_type_id');
            $table->unsignedBigInteger('p_course_id');

            $table->foreign('p_acc_id')->references('acc_id')->on('t_accounts');
            $table->foreign('p_type_id')->references('pt_id')->on('r_post_types');
            $table->foreign('p_course_id')->references('course_id')->on('r_courses');
            $table->timestamps();
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
        Schema::dropIfExists('t_posts');
    }
}
