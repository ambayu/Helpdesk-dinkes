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
      $table->unsignedBigInteger('id_bidang')->nullable(); // Define the new column
      $table->foreign('id_bidang')->references('id')->on('bidang')->onDelete('cascade'); // Example of foreign key constraint
    });
  }

  public function down()
  {
    Schema::table('answers', function (Blueprint $table) {
      $table->dropForeign(['id_bidang']);
      $table->dropColumn('id_bidang'); // Drop the column if the migration is rolled back
    });
  }
};
