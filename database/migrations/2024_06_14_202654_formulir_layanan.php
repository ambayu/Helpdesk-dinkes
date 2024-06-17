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
    Schema::dropIfExists('formulir_layanan');

    Schema::create('formulir_layanan', function (Blueprint $table) {
      $table->id();
      $table->integer('id_menu');
      $table->string('formulir');
      $table->string('type_formulir');
      $table->string('id_user');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //
    Schema::dropIfExists('formulir_layanan');
  }
};
