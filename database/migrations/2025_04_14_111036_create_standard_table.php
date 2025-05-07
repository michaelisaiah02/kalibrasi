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
            $table->float('param_01', 8, 2)->unsigned();
            $table->float('param_02', 8, 2)->unsigned();
            $table->float('param_03', 8, 2)->unsigned();
            $table->float('param_04', 8, 2)->unsigned();
            $table->float('param_05', 8, 2)->unsigned();
            $table->float('param_06', 8, 2)->unsigned();
            $table->float('param_07', 8, 2)->unsigned();
            $table->float('param_08', 8, 2)->unsigned();
            $table->float('param_09', 8, 2)->unsigned();
            $table->float('param_10', 8, 2)->unsigned();
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
