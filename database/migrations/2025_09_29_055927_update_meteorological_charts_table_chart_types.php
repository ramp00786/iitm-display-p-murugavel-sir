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
        // Drop the existing enum constraint and recreate with new values
        Schema::table('meteorological_charts', function (Blueprint $table) {
            // For SQLite, we need to recreate the table or use a workaround
            // Let's change the column to a string type instead of enum
            $table->string('chart_type', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meteorological_charts', function (Blueprint $table) {
            $table->enum('chart_type', [
                'weatherCurrent', 'weatherMinMax', 'temp24h', 'rh24h', 
                'pressure24h', 'wind24h', 'rain24h', 'smpsSizeDist', 
                'smpsConc', 'aethWavelength', 'bc24h', 'bcVsSmps', 'dailyBcSmps'
            ])->change();
        });
    }
};
