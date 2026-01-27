<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panchayat_details', function (Blueprint $table) {
            $table->id();
            // Link to the main Panchayats table
            $table->foreignId('panchayat_id')->constrained('panchayats')->cascadeOnDelete();

            // Section 1: Pradhan & Hero Info
            $table->string('pradhan_name')->nullable();
            $table->string('pradhan_image')->nullable(); // Path to uploaded image
            $table->string('pradhan_contact')->nullable();
            $table->text('about_text')->nullable(); // The "Welcome" message

            // Section 2: Statistics (The Grid)
            $table->integer('total_population')->default(0);
            $table->integer('male_population')->default(0);
            $table->integer('female_population')->default(0);
            $table->string('literacy_rate')->nullable(); // e.g. "90%"
            $table->integer('total_families')->default(0);
            $table->integer('sc_st_population')->default(0);

            // Section 3: Contact & Media
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('address')->nullable();
            $table->string('video_url')->nullable(); // YouTube Embed Link
            $table->text('map_embed_code')->nullable(); // Google Maps Iframe

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panchayat_details');
    }
};