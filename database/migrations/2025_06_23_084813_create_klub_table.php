<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('klub', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tahun_berdiri')->nullable();
            $table->string('stadion')->nullable();
            $table->unsignedBigInteger('negara_id');
            $table->string('logo_klub')->nullable();
            $table->timestamps();

            $table->foreign('negara_id')->references('id')->on('negara')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('klub');
    }
}; 