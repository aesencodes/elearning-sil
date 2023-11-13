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
        Schema::create('tbl_materis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('guru_id');
            $table->foreignUuid('kelas_id')->default('00000000-0000-0000-0000-000000000000');
            $table->string('title_materi');
            $table->longText('file_name_materi')->nullable();
            $table->longText('description_materi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_materis');
    }
};
