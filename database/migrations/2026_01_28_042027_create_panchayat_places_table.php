<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panchayat_places', function (Blueprint $table) {
            $table->id();
            // Foreign key linking to your existing panchayats table
            $table->foreignId('panchayat_id')->constrained('panchayats')->onDelete('cascade');
            
            $table->string('title'); // Name of the specific spot/place
            $table->text('description')->nullable();
            $table->string('photo')->nullable(); // Store the file path
            
            // Optional: for specific location details within the panchayat
            $table->string('address')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panchayat_places');
    }
};