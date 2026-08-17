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
    Schema::create('properties', function (Blueprint $table) {

        $table->id();

        // Owner
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        // Masters
        $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        $table->foreignId('property_type_id')->constrained()->cascadeOnDelete();
        $table->foreignId('state_id')->constrained()->cascadeOnDelete();
        $table->foreignId('city_id')->constrained()->cascadeOnDelete();

        // Basic
        $table->string('title');
        $table->string('slug')->unique();

        $table->longText('description');

        // Price
        $table->decimal('price',15,2);

        // Details
        $table->integer('bedrooms')->default(0);
        $table->integer('bathrooms')->default(0);
        $table->integer('balconies')->default(0);
        $table->integer('parking')->default(0);

        $table->decimal('area',10,2)->nullable();
        $table->string('area_unit')->default('Sq Ft');

        // Location
        $table->string('address');
        $table->string('pincode',20)->nullable();

        $table->decimal('latitude',10,8)->nullable();
        $table->decimal('longitude',11,8)->nullable();

        // Images
        $table->string('featured_image')->nullable();

        // Flags
        $table->boolean('featured')->default(false);
        $table->boolean('status')->default(true);

        // Views
        $table->unsignedBigInteger('views')->default(0);

        // SEO
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
