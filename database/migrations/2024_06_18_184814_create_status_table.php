<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTable extends Migration
{
  public function up()
  {
    Schema::create('status', function (Blueprint $table) {
      $table->id();
      $table->string('nama'); // Kolom untuk menyimpan nama status
      $table->timestamps();
    });

    // Insert data awal
    DB::table('status')->insert([
      ['nama' => 'proses'],
      ['nama' => 'selesai'],
      ['nama' => 'menunggu respon'],
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('status');
  }
}
