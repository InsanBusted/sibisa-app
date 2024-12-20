<?php

use App\Models\Prodi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->string('email');
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->foreign('prodi_id')->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('prodi');
            $table->unsignedBigInteger('jadwal_bimbingan_id')->nullable();
            $table->foreign('jadwal_bimbingan_id')->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('jadwal_bimbingans');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
