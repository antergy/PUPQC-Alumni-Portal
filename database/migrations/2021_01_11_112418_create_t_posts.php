<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPosts extends Migration
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
            $table->id('post_id')->autoIncrement();
            $table->longtext('post_title');
            $table->longtext('post_desc');
            $table->string('post_picture', 225)->nullable();
            $table->unsignedBigInteger('post_acc_id');
            $table->unsignedBigInteger('post_pt_id');
            $table->unsignedBigInteger('post_degree_id')->nullable();
            $table->unsignedBigInteger('post_course_id')->nullable();

            $table->foreign('post_acc_id')->references('acc_id')->on('t_accounts');
            $table->foreign('post_pt_id')->references('pt_id')->on('r_post_types');
            $table->foreign('post_degree_id')->references('degree_id')->on('r_degree');
            $table->foreign('post_course_id')->references('course_id')->on('r_courses');
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
        Schema::dropIfExists('t_posts');
    }
}
