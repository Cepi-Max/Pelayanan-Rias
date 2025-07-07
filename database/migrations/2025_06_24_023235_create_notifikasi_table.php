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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengaju_id')->constrained('users')->onDelete('cascade'); // user pengaju
            $table->foreignId('pengajuan_surat_id')->nullable()->constrained('pengajuan_surat')->onDelete('cascade'); // relasi ke pengajuan
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->onDelete('cascade'); // relasi ke jenis_surat

            $table->string('judul'); // nanti isi dari jenis_surat.nama_jenis
            $table->text('pesan');   // nanti isi dari jenis_surat.deskripsi

            $table->enum('tipe', ['info', 'success', 'warning', 'error'])->default('info');

            $table->boolean('sudah_dibaca_operator')->default(false);
            $table->boolean('sudah_dibaca_masyarakat')->default(false);
            $table->timestamp('dibaca_operator_pada')->nullable();
            $table->timestamp('dibaca_masyarakat_pada')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
