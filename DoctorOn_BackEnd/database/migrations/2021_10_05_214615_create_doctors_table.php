<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('crm');
            $table->char('sex');
            $table->text('img_doctor');
            $table->tinyInteger('active');
            $table->string('start_time');
            $table->string('end_time');

            $table->timestamps();

            $table->unsignedBigInteger('units_id');
            $table->foreign('units_id')->references('id')->on('units')->onDelete('cascade');

            $table->unsignedBigInteger('specialties_id');
            $table->foreign('specialties_id')->references('id')->on('specialties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
