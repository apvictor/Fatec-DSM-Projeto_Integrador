<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('doctor');
            $table->string('crm')->unique();
            $table->char('sex');
            $table->text('uuid');
            $table->string('doctor_img');
            $table->boolean('active');

            $table->unsignedBigInteger('units_id');
            $table->foreign('units_id')->references('id')->on('units')->onDelete('cascade');

            $table->unsignedBigInteger('specialties_id');
            $table->foreign('specialties_id')->references('id')->on('specialties')->onDelete('cascade');
            $table->timestamps();
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
