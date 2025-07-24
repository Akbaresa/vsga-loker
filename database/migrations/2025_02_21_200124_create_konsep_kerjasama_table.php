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
        Schema::create('konsep_kerjasama', function (Blueprint $table) {
            $table->id('id_konsep_kerjasama');
            $table->string('nama_konsep_kerjasama');
            $table->string('deskripsi');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsep_kerjasama');
    }
};
