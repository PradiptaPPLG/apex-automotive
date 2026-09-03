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
            $table->string('ownership_type')->default('individual')->after('postal_code'); // 'individual' | 'company'
            $table->string('ktp_file')->nullable()->after('ownership_type');
            $table->string('kk_file')->nullable()->after('ktp_file');
            $table->string('npwp_file')->nullable()->after('kk_file');
            $table->string('nib_file')->nullable()->after('npwp_file');
            $table->string('akta_file')->nullable()->after('nib_file');
            $table->string('kyc_status')->default('pending')->after('akta_file'); // 'pending' | 'approved' | 'revision'
            $table->text('kyc_notes')->nullable()->after('kyc_status');
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->text('spa_contract_pdf')->nullable()->after('assigned_rm_name');
            $table->boolean('buyer_signed')->default(false)->after('spa_contract_pdf');
            $table->timestamp('buyer_signed_at')->nullable()->after('buyer_signed');
            $table->string('buyer_signature_svg')->nullable()->after('buyer_signed_at');
            $table->boolean('management_signed')->default(false)->after('buyer_signature_svg');
            $table->timestamp('management_signed_at')->nullable()->after('management_signed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'ownership_type', 'ktp_file', 'kk_file', 'npwp_file',
                'nib_file', 'akta_file', 'kyc_status', 'kyc_notes',
            ]);
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn([
                'spa_contract_pdf', 'buyer_signed', 'buyer_signed_at',
                'buyer_signature_svg', 'management_signed', 'management_signed_at',
            ]);
        });
    }
};
