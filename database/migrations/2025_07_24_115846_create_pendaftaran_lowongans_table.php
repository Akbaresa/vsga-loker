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
        Schema::create('pendaftaran_lowongan', function (Blueprint $table) {
            $table->id('id_pendaftaran_lowongan');
            $table->string('file_cv');
            $table->string('surat_lamaran');
            $table->foreignId('lowongan_id')->constrained('lowongan', 'id_lowongan');
            $table->foreignId('status_pendaftar_id')->constrained('status_pendaftar', 'id_status_pendaftar');
            $table->foreignId('karyawan_id')->constrained('karyawan', 'id_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_lowongan');
    }
};
