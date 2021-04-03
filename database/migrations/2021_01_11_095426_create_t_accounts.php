<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_accounts', function (Blueprint $table) {
            $table->id('acc_id')->autoIncrement();
            $table->longText('acc_username')->unique();
            $table->longText('acc_password');
            $table->longText('acc_name');
            $table->longText('acc_email')->unique();
            $table->longText('acc_picture')->default('DEF-PIC');
            $table->unsignedBigInteger('acc_type');
            $table->integer('acc_status')->default(1);

            $table->foreign('acc_type')->references('at_id')->on('r_account_types');
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
        Schema::dropIfExists('t_accounts');
    }
}
