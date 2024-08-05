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
    Schema::table('permintaan_ubah_bidang', function (Blueprint $table) {
      $table->unsignedBigInteger('id_rekomend_menu')->nullable()->after('id'); // Sesuaikan `existing_column` dengan kolom terakhir di tabel Anda
      // Tambahkan foreign key jika diperlukan
      // $table->foreign('id_rekomend_menu')->references('id')->on('nama_tabel_referensi')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('permintaan_ubah_bidang', function (Blueprint $table) {
      $table->dropColumn('id_rekomend_menu');
      // Jika menambahkan foreign key
      // $table->dropForeign(['id_rekomend_menu']);
    });
  }
};
