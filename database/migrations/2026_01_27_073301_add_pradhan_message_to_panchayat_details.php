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
        Schema::table('panchayat_details', function (Blueprint $table) {
            // Adding the column as LONGTEXT (holds up to 4GB of text)
            // Placed after 'about_text' for better organization
            $table->longText('pradhan_message')->nullable()->after('about_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('panchayat_details', function (Blueprint $table) {
            $table->dropColumn('pradhan_message');
        });
    }
};