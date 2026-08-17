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
        Schema::create('property_floor_plans', function (Blueprint $table) {
    $table->id();

    $table->foreignId('property_id')
        ->constrained('properties')
        ->cascadeOnDelete();

    $table->string('title');

    $table->string('configuration')->nullable();

    $table->decimal('area', 12, 2)->nullable();

    $table->string('area_unit', 20)->default('sq.ft');

    $table->decimal('price', 15, 2)->nullable();

    $table->string('image')->nullable();

    $table->unsignedInteger('sort_order')->default(0);

    $table->boolean('status')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_floor_plans');
    }
};
