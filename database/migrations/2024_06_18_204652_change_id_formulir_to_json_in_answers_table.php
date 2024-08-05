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
    Schema::table('answers', function (Blueprint $table) {
      $table->json('formulir')->after('id')->nullable();

      // Hapus kolom id_formulir jika sudah tidak diperlukan
      $table->dropColumn('id_formulir');
    });
  }

  public function down()
  {
    Schema::table('answers', function (Blueprint $table) {
      // Kembalikan ke struktur sebelumnya jika perlu rollback migrasi
      $table->string('id_formulir');
      $table->dropColumn('formulir');
    });
  }
};
