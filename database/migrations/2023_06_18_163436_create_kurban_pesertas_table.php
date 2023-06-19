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
        Schema::create('kurban_pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->index();
            $table->foreignId('masjid_id')->index();
            $table->foreignId('kurban_id')->index();
            $table->foreignId('kurban_hewan_id')->index();
            $table->foreignId('peserta_id')->index();
            $table->bigInteger('total_bayar');
            $table->dateTime('tanggal_bayar');
            $table->string('metode_bayar');
            $table->string('bukti_bayar');
            $table->string('status_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurban_pesertas');
    }
};
