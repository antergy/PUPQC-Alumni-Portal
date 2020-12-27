<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_likes', function (Blueprint $table) {
            $table->id('lk_id')->autoIncrement();
            $table->unsignedBigInteger('lk_post_id');
            $table->unsignedBigInteger('lk_acc_id');
            $table->integer('lk_status')->default(1);
            $table->foreign('lk_post_id')->references('p_id')->on('t_posts');
            $table->foreign('lk_acc_id')->references('acc_id')->on('t_accounts');
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
        Schema::dropIfExists('t_likes');
    }
}
