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
        // The 'role' column is already an unrestricted string, so no schema change needed.
        // The 'mechanic' value is simply stored as a string alongside existing roles.
        // This migration serves as documentation of the new role's introduction.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
