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
        Schema::create('riwayat_bimbingans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_bimbingan_id');
            $table->foreign('jadwal_bimbingan_id')->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('jadwal_bimbingans');
            $table->text('catatan_dosen')->nullable(); // Menambahkan catatan untuk dosen
            $table->text('catatan_mahasiswa')->nullable(); // Menambahkan catatan untuk mahasiswa
            $table->enum('status', ['Proses', 'Revisi', 'ACC'])->default('Proses');
            $table->string('file')->nullable(); // Kolom untuk menyimpan nama file yang diupload
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_bimbingans');
    }
};
