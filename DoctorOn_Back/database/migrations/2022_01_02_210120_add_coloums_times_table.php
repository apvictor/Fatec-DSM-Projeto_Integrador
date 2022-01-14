<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumsTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('times', function (Blueprint $table) {
            $table->unsignedBigInteger('units_id')->nullable();
            $table->foreign('units_id')->references('id')->on('units')->onDelete('cascade');
            
            $table->unsignedBigInteger('doctors_id')->nullable();
            $table->foreign('doctors_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('times', function (Blueprint $table) {
            //
        });
    }
}
