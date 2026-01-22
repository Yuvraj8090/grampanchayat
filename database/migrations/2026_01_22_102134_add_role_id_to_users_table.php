<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Add the column (nullable in case you have existing users)
            // 2. 'constrained()' automatically links to the 'id' on the 'roles' table
            // 3. 'onDelete' sets it to null if a role is deleted (safety)
            $table->foreignId('role_id')
                ->nullable()
                ->after('id') // Places column after 'id' for neatness
                ->constrained('roles')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Must drop the Foreign Key first, then the column
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
