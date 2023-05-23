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
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->index();
            $table->dateTime('tanggal');
            $table->string('kategori')->nullable();
            $table->text('keterangan');
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->bigInteger('jumlah');
            $table->bigInteger('saldo_akhir');
            $table->foreignId('created_by')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas');
    }
};
