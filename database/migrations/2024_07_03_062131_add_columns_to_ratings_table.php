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
    Schema::table('ratings', function (Blueprint $table) {
      $table->string('status')->nullable();
      $table->unsignedBigInteger('id_user_validasi')->nullable();

      // Jika ingin menambahkan constraint foreign key
      // $table->foreign('id_user_validasi')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('ratings', function (Blueprint $table) {
      $table->dropColumn('status');
      $table->dropColumn('id_user_validasi');
    });
  }
};
