<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klub_id');
            $table->string('nama_prestasi');
            $table->string('tahun')->nullable();
            $table->timestamps();

            $table->foreign('klub_id')->references('id')->on('klub')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
}; 