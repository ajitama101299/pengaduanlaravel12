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
        Schema::table('aduans', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aduans', function (Blueprint $table) {
            // Menghapus kolom latitude dan longitude saat rollback migrasi ini
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};