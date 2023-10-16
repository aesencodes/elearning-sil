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
        Schema::create('tbl_gurus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('nuptk', 16, 0)->unique();
            $table->foreignUuid('user_id');
            $table->string('name');
            $table->unsignedBigInteger('gander_id')->nullable();
            $table->integer('nomor_hp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_gurus');
    }
};
