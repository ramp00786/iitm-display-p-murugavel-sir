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
        Schema::create('meteorological_charts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tab_id')->constrained('meteorological_tabs')->onDelete('cascade');
            $table->string('title');
            $table->enum('chart_type', [
                'weatherCurrent', 'weatherMinMax', 'temp24h', 'rh24h', 
                'pressure24h', 'wind24h', 'rain24h', 'smpsSizeDist', 
                'smpsConc', 'aethWavelength', 'bc24h', 'bcVsSmps', 'dailyBcSmps'
            ]);
            $table->json('chart_config')->nullable(); // Store chart specific configuration
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meteorological_charts');
    }
};
