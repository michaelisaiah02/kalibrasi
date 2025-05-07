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

            $table->float('param_01', 8, 2)->nullable();
            $table->float('param_02', 8, 2)->nullable();
            $table->float('param_03', 8, 2)->nullable();
            $table->float('param_04', 8, 2)->nullable();
            $table->float('param_05', 8, 2)->nullable();
            $table->float('param_06', 8, 2)->nullable();
            $table->float('param_07', 8, 2)->nullable();
            $table->float('param_08', 8, 2)->nullable();
            $table->float('param_09', 8, 2)->nullable();
            $table->float('param_10', 8, 2)->nullable();

            $table->enum('judgement', ['OK', 'NG', 'Disposal']);
            $table->char('created_by', 5); // harus cocok dengan tipe employeeID
            $table->foreign('created_by')->references('employeeID')->on('users')->onDelete('cascade');
            $table->string('certificate')->nullable()->default(null);

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
