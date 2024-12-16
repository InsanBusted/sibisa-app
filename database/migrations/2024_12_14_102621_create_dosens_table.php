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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nama');
            $table->string('email');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('prodi');
            $table->unsignedBigInteger('jadwalbimbingan_id')->nullable();
            $table->foreign('jadwalbimbingan_id')->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('jadwal_bimbingans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
