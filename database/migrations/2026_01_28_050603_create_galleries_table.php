<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            
            // Reference to the id in your panchayats table
            $table->foreignId('panchayat_id')
                  ->constrained('panchayats')
                  ->onDelete('cascade'); 
            
            $table->string('path'); // Path to the uploaded image
            $table->string('caption')->nullable(); // Optional title for the photo
            $table->enum('type', ['image', 'video'])->default('image'); // To distinguish media types
            $table->boolean('is_featured')->default(false); // To show on the homepage
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};