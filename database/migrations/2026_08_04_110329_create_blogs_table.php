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
       Schema::create('blogs', function (Blueprint $table) {

    $table->id();

    $table->foreignId('blog_category_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->foreignId('user_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->string('title');
    $table->string('slug')->unique();

    $table->longText('description');

    $table->string('featured_image')->nullable();

    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();

    $table->boolean('status')->default(true);

    $table->unsignedBigInteger('views')->default(0);

    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
