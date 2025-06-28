<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the enum constraint and recreate it with new values
        DB::statement("ALTER TABLE prestasi MODIFY COLUMN kategori ENUM('Liga', 'Cup', 'League Cup', 'Super Cup', 'Piala Internasional') DEFAULT 'Liga'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE prestasi MODIFY COLUMN kategori ENUM('Liga', 'Cup', 'League Cup', 'Piala Internasional') DEFAULT 'Liga'");
    }
};
