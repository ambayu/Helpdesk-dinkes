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
    Schema::dropIfExists('menu');

    Schema::create('menu', function (Blueprint $table) {
      $table->id();
      $table->string('nama_layanan')->unique();
      $table->string('slug')->unique();
      $table->string('file');
      $table->string('id_user');
      $table->string('status');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('menu');
  }
};
