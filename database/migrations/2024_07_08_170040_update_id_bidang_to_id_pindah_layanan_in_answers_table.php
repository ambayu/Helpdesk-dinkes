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
    Schema::table('answers', function (Blueprint $table) {
      //
      // Drop foreign key constraint if it exists


      // Add the new foreign key constraint

      $table->foreign('id_pindah_layanan')
        ->references('id')
        ->on('permintaan_ubah_bidang')
        ->onDelete('cascade');
    });
    Schema::table('respon_answer', function (Blueprint $table) {
      $table->dropColumn('status_answer');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('answers', function (Blueprint $table) {
    });
    Schema::table('respon_answer', function (Blueprint $table) {
      $table->string('status_answer')->nullable();
    });
  }
};
