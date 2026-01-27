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
        Schema::create('user_locations', function (Blueprint $table) {
            $table->id();

            // 1. Foreign Keys
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('state_id')->constrained('states')->cascadeOnDelete();
            $table->foreignId('district_id')->nullable()->constrained('districts')->cascadeOnDelete();
            $table->foreignId('block_id')->nullable()->constrained('blocks')->cascadeOnDelete();
            $table->foreignId('panchayat_id')->nullable()->constrained('panchayats')->cascadeOnDelete();

            $table->timestamps();

            // 2. Strict Unique Constraint Logic
            // We create a "virtual" string that concatenates IDs. If an ID is null, we use '0'.
            // This ensures strict uniqueness even when fields are NULL.
            $table->string('location_hash')->virtualAs(
                "CONCAT(
                    user_id, '-', 
                    state_id, '-', 
                    COALESCE(district_id, '0'), '-', 
                    COALESCE(block_id, '0'), '-', 
                    COALESCE(panchayat_id, '0')
                )"
            );
            
            // Apply the unique key on the hash
            $table->unique('location_hash', 'unique_user_assignment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_locations');
    }
};