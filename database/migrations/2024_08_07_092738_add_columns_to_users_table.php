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
    Schema::table('users', function (Blueprint $table) {
      $table->string('jenis_kelamin')->nullable(); // Menambahkan kolom jenis_kelamin
      $table->boolean('sso')->default(0); // Menambahkan kolom sso dengan nilai default 0
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table) {
      //
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['jenis_kelamin', 'sso']); // Menghapus kolom jika rollback
      });
    });
  }
};
