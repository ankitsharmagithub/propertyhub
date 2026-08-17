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
        Schema::create('property_landmarks', function (Blueprint $table) {
    $table->id();

    $table->foreignId('property_id')
        ->constrained('properties')
        ->cascadeOnDelete();

    $table->string('name');

    $table->decimal('distance', 10, 2)->nullable();

    $table->string('distance_unit', 20)->default('km');

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
        Schema::dropIfExists('property_landmarks');
    }
};
