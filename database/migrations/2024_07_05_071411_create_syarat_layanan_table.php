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
    Schema::create('syarat_layanan', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_menu');
      $table->text('syarat');
      $table->text('cara_penggunaan');
      $table->timestamps();
      $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('syarat_layanan');
  }
};
