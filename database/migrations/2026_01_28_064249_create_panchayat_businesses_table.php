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
        Schema::create('panchayat_businesses', function (Blueprint $table) {
            $table->id();
             $table->foreignId('panchayat_id')
                  ->constrained('panchayats')
                  ->onDelete('cascade'); 
            $table->string('title'); // Business Name
            $table->text('description')->nullable(); // Details
            $table->string('image')->nullable(); // Image Path

            // Status: true for Active, false for Inactive
           $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panchayat_businesses');
    }
};
