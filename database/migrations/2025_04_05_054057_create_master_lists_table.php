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
        Schema::create('master_lists', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_id')->foreign('tipe_id')->references('tipe_id')->on('alat_ukurs')->onDelete('cascade');
            $table->string('no_id')->unique();
            $table->string('no_sn');
            $table->integer('kapasitas')->unsigned();
            $table->integer('ketelitian')->unsigned();
            $table->string('std_ukuran');
            $table->string('merk');
            $table->date('tgl_kalibrasi');
            $table->enum('tipe_kalibrasi', ['Internal', 'External']);
            $table->date('first_used');
            $table->string('rank');
            $table->integer('freq_kalibrasi');
            $table->string('pic_pengguna');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_lists');
    }
};
