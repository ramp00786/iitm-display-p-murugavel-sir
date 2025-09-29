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
        Schema::create('chart_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chart_id')->constrained('meteorological_charts')->onDelete('cascade');
            $table->json('data'); // Store chart data as JSON
            $table->json('labels')->nullable(); // Store chart labels
            $table->json('datasets')->nullable(); // Store multiple datasets for complex charts
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chart_data');
    }
};
