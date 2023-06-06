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
            Schema::create('kategoris', function (Blueprint $table) {
                $table->id();
                $table->foreignId('masjid_id')->index();
                $table->foreignId('parent_id')->index()->default(0);
                $table->string('slug');
                $table->string('nama');
                $table->string('keterangan')->nullable();
                $table->foreignId('created_by')->index();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('kategoris');
        }
    };
