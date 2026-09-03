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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('car_model')->nullable();
            $table->text('selected_config')->nullable(); // JSON: bodykit, warna, dll
            $table->text('notes')->nullable();
            $table->string('status')->default('inquiry_received');
            // status: inquiry_received | consultation_active | spk_issued | kyc_pending
            //         kyc_approved | contract_signed | payment_verified
            //         scheduled_delivery | delivered_completed
            $table->string('assigned_rm_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
