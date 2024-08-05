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
      $table->string('nama_bidang'); // Tambahkan kolom nama_bidang
      $table->timestamps();
      $table->softDeletes(); // Menambahkan kolom deleted_at

      $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');
    });

    Schema::table('formulir_layanan', function (Blueprint $table) {
      $table->softDeletes(); // Menambahkan kolom deleted_at
    });

    Schema::table('menu', function (Blueprint $table) {
      $table->softDeletes(); // Menambahkan kolom deleted_at
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('menu_bidang');

    Schema::table('formulir_layanan', function (Blueprint $table) {
      $table->dropSoftDeletes(); // Menghapus kolom deleted_at
    });

    Schema::table('menu', function (Blueprint $table) {
      $table->dropSoftDeletes(); // Menghapus kolom deleted_at
    });
  }
};
