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
      $table->integer('status_answer')->default('0')->after('deskripsi'); // Ganti 'some_column' dengan kolom yang ada di tabel Anda.
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('answers', function (Blueprint $table) {
      //
      $table->dropColumn('status_answer');
    });
  }
};
