<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::table('ratings', function (Blueprint $table) {
      $table->unsignedBigInteger('id_answer')->nullable()->after('id'); // Menambah kolom id_answer setelah rated_id
    });
  }

  public function down()
  {
    Schema::table('ratings', function (Blueprint $table) {
      $table->dropColumn('id_answer');
    });
  }
};
