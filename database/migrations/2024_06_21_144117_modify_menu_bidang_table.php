<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('menu_bidang', function (Blueprint $table) {
      $table->dropColumn('nama_bidang'); // Hapus kolom nama_bidang
      $table->unsignedBigInteger('id_bidang'); // Tambahkan kolom id_bidang
      $table->foreign('id_bidang')->references('id')->on('bidang')->onDelete('cascade'); // Tambahkan foreign key
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('menu_bidang', function (Blueprint $table) {
      $table->dropForeign(['id_bidang']); // Hapus foreign key
      $table->dropColumn('id_bidang'); // Hapus kolom id_bidang
      $table->string('nama_bidang'); // Tambahkan kembali kolom nama_bidang
    });
  }
};
