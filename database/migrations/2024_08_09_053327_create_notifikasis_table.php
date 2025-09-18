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
    Schema::create('notifikasis', function (Blueprint $table) {
      $table->id();
      $table->string('nomor_tiket');
      $table->number('id_user');
      $table->string('status');
      $table->text('deskripsi');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('notifikasis');
  }
};
