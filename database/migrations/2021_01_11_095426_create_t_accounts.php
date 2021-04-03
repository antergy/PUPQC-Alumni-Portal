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
            $table->string('acc_username', 200)->unique();
            $table->longText('acc_password');
            $table->longText('acc_name');
            $table->string('acc_email', 200)->unique();
            $table->longText('acc_picture')->nullable();
            $table->unsignedBigInteger('acc_type');
            $table->integer('acc_status')->default(1);

            $table->foreign('acc_type')->references('at_id')->on('r_account_types');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
