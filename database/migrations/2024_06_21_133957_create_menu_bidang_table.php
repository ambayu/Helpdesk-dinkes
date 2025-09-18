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
    Schema::create('menu_bidang', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_menu');
      $table->string('nama_bidang');
      $table->timestamps();
      $table->softDeletes(); // kolom deleted_at

      $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');
    });

    Schema::table('formulir_layanan', function (Blueprint $table) {
      if (!Schema::hasColumn('formulir_layanan', 'deleted_at')) {
        $table->softDeletes();
      }
    });

    // 🚫 tidak perlu apa-apa untuk tabel `menu` karena sudah punya deleted_at
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('menu_bidang');

    Schema::table('formulir_layanan', function (Blueprint $table) {
      if (Schema::hasColumn('formulir_layanan', 'deleted_at')) {
        $table->dropSoftDeletes();
      }
    });

    // 🚫 jangan dropSoftDeletes di menu, karena tidak ada add di up()
  }
};
