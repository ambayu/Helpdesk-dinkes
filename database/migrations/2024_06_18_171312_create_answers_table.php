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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();

            // Relasi ke menu
            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');

            // Relasi ke formulir_layanan
            $table->unsignedBigInteger('id_formulir');
            $table->foreign('id_formulir')->references('id')->on('formulir_layanan')->onDelete('cascade');

            $table->unsignedBigInteger('nomor_tiket')->nullable();
            $table->string('respon');

            // Custom kolom tanggal kirim
            $table->timestamp('tanggal_kirim')->nullable();

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
