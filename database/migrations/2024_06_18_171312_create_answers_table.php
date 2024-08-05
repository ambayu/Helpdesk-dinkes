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

    Schema::create('answers', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_menu')->after('id');
      $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');

      $table->string('id_formulir');
      $table->foreign('id_formulir')->references('id')->on('formulir_layanan')->onDelete('cascade');
      $table->unsignedBigInteger('nomor_tiket')->after('respon')->nullable();
      $table->string('respon');

      $table->timestamps('tanggal_kirim');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('answers');
  }
};
