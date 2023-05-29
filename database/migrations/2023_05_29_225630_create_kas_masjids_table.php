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
            Schema::create('kas_masjids', function (Blueprint $table) {
                $table->id();
                $table->foreignId('masjid_id')->index();
                $table->date('tanggal');
                $table->bigInteger('saldo_akhir')->default(0);
                $table->string('created_by')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('kas_masjids');
        }
    };
