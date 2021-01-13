<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAlumniSharedContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('t_alumni_shared_contact', function (Blueprint $table) {
            $table->id('asc_id')->autoIncrement();
            $table->unsignedBigInteger('asc_shared_by');
            $table->longText('asc_name');
            $table->longText('asc_email');
            $table->longText('asc_contact_num');

            $table->foreign('asc_shared_by')->references('al_id')->on('t_alumni');
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
        Schema::dropIfExists('t_alumni_shared_contact');
    }
}
