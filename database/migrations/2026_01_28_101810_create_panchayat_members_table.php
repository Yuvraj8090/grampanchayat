<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panchayat_members', function (Blueprint $table) {
            // क्रमांक (Serial Number / Primary Key)
            $table->id();

            // Panchayat Relationship (Foreign Key)
            $table->foreignId('panchayat_id')
                ->constrained('panchayats')
                ->onDelete('cascade');

            // नाम (Name)
            $table->string('name');

            // पद (Designation)
            $table->string('designation');

            // वार्ड (Ward Number)
            $table->string('ward_no')->nullable();

            // फ़ोन नंबर (Phone Number)
            $table->string('phone', 20)->nullable();

            // Image (File Path)
            $table->string('image')->nullable();

            // क्रम (Manual Sorting Order) - Use this to decide who shows first
            $table->integer('order_by')->default(0)->index();

            // स्थिति (Status)
            $table->enum('status', ['active', 'inactive'])->default('active')->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panchayat_members');
    }
};