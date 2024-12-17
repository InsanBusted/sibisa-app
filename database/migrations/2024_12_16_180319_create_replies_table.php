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
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->text('content');  // Isi balasan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // User yang memberikan balasan
            $table->foreignId('forum_id')->constrained('forum_diskusis')->onDelete('cascade');  // Forum yang dibalas
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
