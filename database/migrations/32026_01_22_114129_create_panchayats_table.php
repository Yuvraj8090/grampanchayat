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
    Schema::create('panchayats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('block_id')->constrained()->onDelete('cascade');
        $table->string('name'); // Village/Panchayat Name
        $table->string('panchayat_id')->unique(); // Unique ID (e.g., UK-DEH-001)
        
        // Account Status for Super Admin Control
        $table->enum('status', ['pending', 'active', 'suspended'])->default('pending');
        
        $table->string('vpo_name')->nullable(); // Village Panchayat Officer name
        $table->text('address')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panchayats');
    }
};
