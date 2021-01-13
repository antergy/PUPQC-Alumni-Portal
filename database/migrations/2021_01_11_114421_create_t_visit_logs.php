<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTVisitLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_visit_logs', function (Blueprint $table) {
            $table->id('vs_id')->autoIncrement();
            $table->unsignedBigInteger('vs_acc_id');

            $table->foreign('vs_acc_id')->references('acc_id')->on('t_accounts');
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
        Schema::dropIfExists('t_visit_logs');
    }
}
