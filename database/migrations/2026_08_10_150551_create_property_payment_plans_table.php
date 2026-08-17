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
        Schema::create('property_payment_plans', function (Blueprint $table) {
    $table->id();

    $table->foreignId('property_id')
        ->constrained('properties')
        ->cascadeOnDelete();

    $table->string('unit_type')->nullable();

    $table->decimal('size', 12, 2)->nullable();

    $table->string('size_unit', 20)->default('sq.ft');

    $table->decimal('price_per_sqft', 15, 2)->nullable();

    $table->decimal('amount', 15, 2)->nullable();

    $table->decimal('booking_amount', 15, 2)->nullable();

    $table->text('description')->nullable();

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
        Schema::dropIfExists('property_payment_plans');
    }
};
