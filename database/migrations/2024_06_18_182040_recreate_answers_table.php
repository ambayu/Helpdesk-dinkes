<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateAnswersTable extends Migration
{
  public function up()
  {
    Schema::dropIfExists('answers');

    Schema::create('answers', function (Blueprint $table) {
      $table->bigIncrements('id'); // ID yang otomatis bertambah
      $table->unsignedBigInteger('id_menu')->nullable(); // Kolom unsigned bigint
      $table->string('id_formulir'); // Kolom string (ubah ke integer jika perlu)
      $table->unsignedBigInteger('id_ticket');
      $table->timestamp('tanggal_kirim'); // Kolom timestamp
      $table->timestamps(); // Kolom created_at dan updated_at otomatis
    });
  }

  public function down()
  {
    Schema::dropIfExists('answers');
  }
}
