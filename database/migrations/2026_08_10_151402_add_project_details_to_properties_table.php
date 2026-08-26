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
         if (Schema::hasColumn('properties', 'developer_id')) {
        return;
    }
        Schema::table('properties', function (Blueprint $table) {

    $table->foreignId('developer_id')
        ->nullable()
        ->after('property_type_id')
        ->constrained('developers')
        ->nullOnDelete();

    $table->string('project_status')
        ->nullable()
        ->after('availability');

    $table->date('possession_date')
        ->nullable()
        ->after('project_status');

    $table->string('rera_number')
        ->nullable()
        ->after('possession_date');

    $table->string('rera_status')
        ->nullable()
        ->after('rera_number');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {

    $table->dropForeign(['developer_id']);

    $table->dropColumn([
        'developer_id',
        'project_status',
        'possession_date',
        'rera_number',
        'rera_status',
    ]);
});
    }
};
