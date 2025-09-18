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
        Schema::table('answers', function (Blueprint $table) {
            // Pastikan kolom ada dulu
            if (!Schema::hasColumn('answers', 'id_pindah_layanan')) {
                $table->unsignedBigInteger('id_pindah_layanan')->nullable();
            }

            // Baru tambahkan foreign key
            $table->foreign('id_pindah_layanan')
                ->references('id')
                ->on('permintaan_ubah_bidang')
                ->onDelete('cascade');
        });

        // Hapus kolom status_answer dari respon_answer
        Schema::table('respon_answer', function (Blueprint $table) {
            if (Schema::hasColumn('respon_answer', 'status_answer')) {
                $table->dropColumn('status_answer');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            if (Schema::hasColumn('answers', 'id_pindah_layanan')) {
                $table->dropForeign(['id_pindah_layanan']);
                $table->dropColumn('id_pindah_layanan');
            }
        });

        Schema::table('respon_answer', function (Blueprint $table) {
            if (!Schema::hasColumn('respon_answer', 'status_answer')) {
                $table->string('status_answer')->nullable();
            }
        });
    }
};
