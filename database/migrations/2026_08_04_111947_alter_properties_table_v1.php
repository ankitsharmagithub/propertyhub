<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->string('property_code',30)
                  ->unique()
                  ->after('id');

            $table->text('short_description')
                  ->nullable()
                  ->after('slug');

            $table->integer('floor')
                  ->nullable()
                  ->after('parking');

            $table->integer('total_floors')
                  ->nullable()
                  ->after('floor');

            $table->enum('availability',[
                'available',
                'sold',
                'rented',
                'booked'
            ])->default('available')->after('featured');

        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->dropColumn([
                'property_code',
                'short_description',
                'floor',
                'total_floors',
                'availability'
            ]);

        });
    }
};