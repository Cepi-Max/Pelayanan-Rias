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
        Schema::create('pengajuan_selesai', function (Blueprint $table) {
            $table->id();
            // kolom untuk manual
            $table->string('nama')->nullable();
            $table->foreignId('jenis_surat_id')->nullable()->constrained('jenis_surat')->onDelete('cascade');
            // otomatis
            $table->foreignId('pengajuan_id')->nullable()->constrained('pengajuan_surat')->onDelete('cascade')->nullable();
            $table->string('surat_diminta');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_selesai');
    }
};
