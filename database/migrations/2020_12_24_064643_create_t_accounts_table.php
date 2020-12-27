<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAccountsTable extends Migration
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
            $table->string('acc_username', 50);
            $table->string('acc_password', 50);
            $table->string('acc_name', 100);
            $table->string('acc_email', 100);
            $table->string('acc_picture', 225)
                ->default('default_image.jpg');
            $table->unsignedBigInteger('acc_type_id');
            $table->integer('acc_status')->default(1);

            $table->foreign('acc_type_id')->references('at_id')->on('r_account_types');
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
        Schema::dropIfExists('t_accounts');
    }
}
