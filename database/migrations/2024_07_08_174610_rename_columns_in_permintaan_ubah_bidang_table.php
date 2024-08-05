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
      // Rename kolom id_bidang_lama menjadi id_menu_lama
      $table->renameColumn('id_bidang_lama', 'id_menu_lama');

      // Rename kolom id_bidang_baru menjadi id_menu_baru
      $table->renameColumn('id_bidang_baru', 'id_menu_baru');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('permintaan_ubah_bidang', function (Blueprint $table) {
      // Kembalikan nama kolom id_menu_lama menjadi id_bidang_lama
      $table->renameColumn('id_menu_lama', 'id_bidang_lama');

      // Kembalikan nama kolom id_menu_baru menjadi id_bidang_baru
      $table->renameColumn('id_menu_baru', 'id_bidang_baru');
    });
  }
};
