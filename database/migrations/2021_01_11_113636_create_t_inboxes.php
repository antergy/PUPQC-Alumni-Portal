<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTInboxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_inboxes', function (Blueprint $table) {
            $table->id('in_id')->autoIncrement();
            $table->longText('in_subject');
            $table->longText('in_message');
            $table->unsignedBigInteger('in_acc_id_from');
            $table->unsignedBigInteger('in_acc_id_to');

            $table->foreign('in_acc_id_from')->references('acc_id')->on('t_accounts');
            $table->foreign('in_acc_id_to')->references('acc_id')->on('t_accounts');
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
        Schema::dropIfExists('t_inboxes');
    }
}
