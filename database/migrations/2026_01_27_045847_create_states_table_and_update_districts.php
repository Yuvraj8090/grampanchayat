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
        // 1. Create the 'states' table first
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('state_code')->unique()->nullable(); // e.g., UK for Uttarakhand
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Add 'state_id' to the existing 'districts' table
        Schema::table('districts', function (Blueprint $table) {
            // Adding state_id after 'id' column for better organization
            $table->foreignId('state_id')
                ->after('id')
                ->nullable() // Nullable initially to prevent errors with existing data
                ->constrained('states')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Drop the foreign key and column from 'districts'
        Schema::table('districts', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
            $table->dropColumn('state_id');
        });

        // 2. Drop the 'states' table
        Schema::dropIfExists('states');
    }
};
