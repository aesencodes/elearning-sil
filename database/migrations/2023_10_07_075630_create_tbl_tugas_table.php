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
        Schema::create('tbl_tugas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('id_guru')->constrained();
            $table->string('judul_tugas');
            $table->longText('deskripsi_tugas');
            $table->longText('file_upload_tugas')->nullable();
            $table->unsignedBigInteger('id_kelas')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tugas');
    }
};
