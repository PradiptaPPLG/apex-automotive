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
        Schema::create('service_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('service_bookings')->cascadeOnDelete();
            $table->string('phase_label');
            $table->text('note')->nullable();
            $table->string('photo_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_progress');
    }
};
