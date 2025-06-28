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
        Schema::create('prestasi_negara', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('negara_id');
            $table->string('nama_prestasi');
            $table->string('tahun');
            $table->timestamps();

            $table->foreign('negara_id')->references('id')->on('negara')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_negara');
    }
};
