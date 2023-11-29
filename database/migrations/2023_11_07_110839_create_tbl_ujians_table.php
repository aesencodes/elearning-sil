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
        Schema::create('tbl_ujians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kelas_id');
            $table->foreignUuid('guru_id');
            $table->text('judul_ujian');
            $table->longText('description');
            $table->longText('nama_file_ujian');
            $table->dateTime('deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ujians');
    }
};
