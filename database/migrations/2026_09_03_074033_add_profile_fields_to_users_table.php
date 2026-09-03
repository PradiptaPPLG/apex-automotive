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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('nik', 16)->nullable()->after('phone');
            $table->string('npwp', 20)->nullable()->after('nik');
            $table->string('address')->nullable()->after('npwp');
            $table->string('city')->nullable()->after('address');
            $table->string('province')->nullable()->after('city');
            $table->string('postal_code', 10)->nullable()->after('province');
            $table->boolean('profile_completed')->default(false)->after('postal_code');
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'nik', 'npwp', 'address',
                'city', 'province', 'postal_code', 'profile_completed',
            ]);
            $table->string('password')->nullable(false)->change();
        });
    }
};
