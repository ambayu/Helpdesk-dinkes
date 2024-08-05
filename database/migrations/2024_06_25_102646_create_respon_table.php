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
    Schema::table('respon_answer', function (Blueprint $table) {
      // Rename id_ticket to id_answer
      $table->renameColumn('id_ticket', 'id_answer');

      // Add file and status_respon columns
      $table->string('file')->nullable();
      $table->string('status_answer')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('respon_answer', function (Blueprint $table) {
      // Rename id_answer back to id_ticket
      $table->renameColumn('id_answer', 'id_ticket');

      // Drop the file and status_respon columns
      $table->dropColumn('file');
      $table->dropColumn('status_respon');
    });
  }
};
