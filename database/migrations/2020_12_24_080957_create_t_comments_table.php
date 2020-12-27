<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_comments', function (Blueprint $table) {
            $table->id('cm_id')->autoIncrement();
            $table->longText('cm_desc');
            $table->unsignedBigInteger('cm_post_id');
            $table->unsignedBigInteger('cm_acc_id');
            $table->foreign('cm_post_id')->references('p_id')->on('t_posts');
            $table->foreign('cm_acc_id')->references('acc_id')->on('t_accounts');
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
        Schema::dropIfExists('t_comments');
    }
}
