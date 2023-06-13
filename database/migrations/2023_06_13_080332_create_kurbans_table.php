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
        Schema::create('kurbans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->index();
            $table->integer('tahun_hijriah');
            $table->integer('tahun_masehi');
            $table->longText('konten');
            $table->dateTime('tanggal_akhir_pendaftaran');
            $table->foreignId('created_by')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurbans');
    }
};
