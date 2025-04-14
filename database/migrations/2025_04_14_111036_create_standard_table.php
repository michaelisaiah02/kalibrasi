<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('standard', function (Blueprint $table) {
            $table->id();
            $table->integer('id_num')->foreign('id_num')->references('id_num')->on('master_lists')->onDelete('cascade');
            $table->integer('parameter_01')->unsigned();
            $table->integer('parameter_02')->unsigned();
            $table->integer('parameter_03')->unsigned();
            $table->integer('parameter_04')->unsigned();
            $table->integer('parameter_05')->unsigned();
            $table->integer('parameter_06')->unsigned();
            $table->integer('parameter_07')->unsigned();
            $table->integer('parameter_08')->unsigned();
            $table->integer('parameter_09')->unsigned();
            $table->integer('parameter_10')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('std_equipment');
    }
};
