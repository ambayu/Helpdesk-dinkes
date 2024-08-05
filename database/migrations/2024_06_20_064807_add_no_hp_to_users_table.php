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
    Schema::table('users', function (Blueprint $table) {
      $table->string('no_hp', 15)->nullable()->after('password'); // Ganti 'column_name' dengan nama kolom terakhir di tabel users
      $table->softDeletes();
    });

    Schema::create('role_bidang', function (Blueprint $table) {
      $table->id();
      $table->integer('id_user');
      $table->integer('id_bidang');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table) {
      //
      $table->dropColumn('no_hp');
      $table->dropSoftDeletes();
    });

    Schema::dropIfExists('role_bidang');
  }
};
