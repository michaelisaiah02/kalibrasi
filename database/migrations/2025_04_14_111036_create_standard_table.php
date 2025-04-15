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
        Schema::create('standards', function (Blueprint $table) {
            $table->id();
            $table->string('id_num')->foreign('id_num')->references('id_num')->on('master_lists')->onDelete('cascade');
            $table->integer('param_01')->unsigned();
            $table->integer('param_02')->unsigned();
            $table->integer('param_03')->unsigned();
            $table->integer('param_04')->unsigned();
            $table->integer('param_05')->unsigned();
            $table->integer('param_06')->unsigned();
            $table->integer('param_07')->unsigned();
            $table->integer('param_08')->unsigned();
            $table->integer('param_09')->unsigned();
            $table->integer('param_10')->unsigned();
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
