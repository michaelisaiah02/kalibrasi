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
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            // Foreign key ke master_lists
            $table->string('id_num');
            $table->foreign('id_num')->references('id_num')->on('master_lists')->onDelete('cascade');

            $table->date('calibration_date')->default(now());
            $table->string('calibrator_equipment')->nullable()->default(null);
            $table->foreign('calibrator_equipment')->references('id_num')->on('master_lists')->onDelete('cascade');

            $table->unsignedInteger('param_01')->nullable();
            $table->unsignedInteger('param_02')->nullable();
            $table->unsignedInteger('param_03')->nullable();
            $table->unsignedInteger('param_04')->nullable();
            $table->unsignedInteger('param_05')->nullable();
            $table->unsignedInteger('param_06')->nullable();
            $table->unsignedInteger('param_07')->nullable();
            $table->unsignedInteger('param_08')->nullable();
            $table->unsignedInteger('param_09')->nullable();
            $table->unsignedInteger('param_10')->nullable();

            $table->string('judgement'); // "Pass" / "Fail" atau enum kalau mau
            $table->char('created_by', 5); // harus cocok dengan tipe idKaryawan
            $table->foreign('created_by')->references('idKaryawan')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
