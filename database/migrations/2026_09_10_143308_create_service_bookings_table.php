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
        Schema::create('service_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained('customer_vehicles')->cascadeOnDelete();
            $table->enum('service_type', [
                'periodic_service',
                'performance_tuning',
                'bodywork',
                'exhaust',
                'suspension',
                'custom',
            ])->default('periodic_service');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('preferred_date')->nullable();
            $table->time('preferred_time')->nullable();
            $table->enum('delivery_method', ['drop_off', 'vip_pickup'])->default('drop_off');
            $table->enum('status', [
                'pending',
                'confirmed',
                'in_progress',
                'qc_check',
                'ready',
                'completed',
                'cancelled',
            ])->default('pending');
            $table->string('assigned_mechanic_name')->nullable();
            $table->decimal('estimated_cost', 15, 2)->nullable();
            $table->decimal('actual_cost', 15, 2)->nullable();
            $table->json('reference_images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_bookings');
    }
};
