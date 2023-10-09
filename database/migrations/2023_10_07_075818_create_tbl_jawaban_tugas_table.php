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
            $table->unsignedBigInteger('id_tugas')->constrained();
            $table->unsignedBigInteger('id_siswa')->constrained();
            $table->longText('file_upload_jawab');
            $table->tinyInteger('nilai');
            $table->longText('keterangan');
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
