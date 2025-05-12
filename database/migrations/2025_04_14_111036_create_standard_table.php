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
            $table->decimal('param_01', 10, 2);
            $table->decimal('param_02', 10, 2);
            $table->decimal('param_03', 10, 2);
            $table->decimal('param_04', 10, 2);
            $table->decimal('param_05', 10, 2);
            $table->decimal('param_06', 10, 2);
            $table->decimal('param_07', 10, 2);
            $table->decimal('param_08', 10, 2);
            $table->decimal('param_09', 10, 2);
            $table->decimal('param_10', 10, 2);
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
