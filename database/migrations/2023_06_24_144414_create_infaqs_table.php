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
    Schema::create('infaqs', function (Blueprint $table) {
      $table->id();
      $table->foreignId('masjid_id')->index();
      $table->foreignId('created_by')->index();
      $table->string('sumber')->comment('Sumber infaq, instansi, perorang, koatak-amal, dll');
      $table->string('atas_nama');
      $table->string('jenis')->comment('barang, uang');
      $table->bigInteger('jumlah')->comment('jumlah barang atau uang');
      $table->string('satuan');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('infaqs');
  }
};
