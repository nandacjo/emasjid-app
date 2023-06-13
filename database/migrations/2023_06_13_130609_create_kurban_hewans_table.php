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
        Schema::create('kurban_hewans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->index();
            $table->foreignId('kurban_id')->index();
            $table->foreignId('created_by')->index();
            $table->string('hewan');
            $table->string('kriteria')->nullable();
            $table->bigInteger('harga')->nullable();
            $table->bigInteger('iuran_perorang');
            $table->bigInteger('biaya_operasional')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurban_hewans');
    }
};
