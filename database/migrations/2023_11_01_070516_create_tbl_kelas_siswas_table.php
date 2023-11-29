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
        Schema::create('tbl_kelas_siswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kelas_id');
            $table->foreignUuid('siswa_id');
            $table->foreignUuid('status_siswa_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kelas_siswas');
    }
};
