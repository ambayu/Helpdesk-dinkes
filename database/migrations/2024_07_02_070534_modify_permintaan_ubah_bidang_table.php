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
    //
    Schema::dropIfExists('permintaan_ubah_bidang');
    Schema::create('permintaan_ubah_bidang', function (Blueprint $table) {
      $table->id();
      $table->integer('id_user')->constrained()->onDelete('cascade');
      $table->integer('id_answer')->constrained()->onDelete('cascade');
      $table->integer('id_bidang_lama')->onDelete('cascade');
      $table->integer('id_bidang_baru')->onDelete('cascade');
      $table->text('alasan');
      $table->boolean('disetujui')->default(false);
      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //    Schema::dropIfExists('permintaan_permintaan_ubah_bidang');
    Schema::dropIfExists('permintaan_ubah_bidang');
  }
};
