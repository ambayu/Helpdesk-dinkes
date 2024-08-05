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
    Schema::table('permintaan_ubah_bidang', function (Blueprint $table) {
      $table->foreignId('id_user_validasi')->nullable()->constrained('users')->onDelete('set null');
    });
  }

  public function down()
  {
    Schema::table('permintaan_ubah_bidang', function (Blueprint $table) {
      $table->dropForeign(['id_user_validasi']);
      $table->dropColumn('id_user_validasi');
    });
  }
};
