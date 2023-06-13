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
        Schema::create('masjid_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->index();
            $table->string('nama_bank');
            $table->string('kode_bank');
            $table->string('nama_rekening');
            $table->string('nomor_rekening');
            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masjid_banks');
    }
};
