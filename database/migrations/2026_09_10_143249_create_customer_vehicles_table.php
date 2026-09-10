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
        Schema::create('customer_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('brand');
            $table->string('model');
            $table->integer('year')->nullable();
            $table->string('color')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('vin')->nullable();
            $table->integer('mileage_km')->nullable();
            $table->string('image_url')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_vehicles');
    }
};
