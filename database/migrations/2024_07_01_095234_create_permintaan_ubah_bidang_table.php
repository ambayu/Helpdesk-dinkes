<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('permintaan_ubah_bidang', function (Blueprint $table) {
      $table->id();
      $table->integer('id_user')->constrained()->onDelete('cascade');
      $table->integer('id_bidang_lama')->onDelete('cascade');
      $table->integer('id_bidang_baru')->onDelete('cascade');
      $table->text('alasan');
      $table->boolean('disetujui')->default(false);
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('permintaan_ubah_bidang');
  }
};
