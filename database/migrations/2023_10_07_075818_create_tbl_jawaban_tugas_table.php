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
        Schema::create('tbl_jawaban_tugas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_tugas');
            $table->foreignUuid('id_kelas');
            $table->foreignUuid('id_siswa');
            $table->longText('file_upload_jawab');
            $table->tinyInteger('nilai')->nullable();
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_jawaban_tugas');
    }
};
