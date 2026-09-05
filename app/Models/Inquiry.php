<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id', 'name', 'email', 'phone',
    'car_model', 'selected_config', 'notes',
    'status', 'assigned_rm_name',
    'spa_contract_pdf', 'buyer_signed', 'buyer_signed_at',
    'buyer_signature_svg', 'management_signed', 'management_signed_at',
])]
class Inquiry extends Model
{
    protected function casts(): array
    {
        return [
            'buyer_signed' => 'boolean',
            'buyer_signed_at' => 'datetime',
            'management_signed' => 'boolean',
            'management_signed_at' => 'datetime',
        ];
    }

    /**
     * Get all available status codes mapped to display labels.
     *
     * @return array<string, string>
     */
    public static function statusLabels(): array
    {
        return [
            'inquiry_received' => 'Lead Diterima',
            'consultation_active' => 'Konsultasi Aktif',
            'spk_issued' => 'SPK Diterbitkan',
            'kyc_pending' => 'Menunggu Dokumen KYC',
            'kyc_approved' => 'KYC Disetujui',
            'contract_signed' => 'Kontrak Ditandatangani',
            'payment_verified' => 'Pembayaran Terkonfirmasi',
            'scheduled_delivery' => 'Dijadwalkan Pengiriman',
            'delivered_completed' => 'Selesai — Kendaraan Diterima',
        ];
    }

    /**
     * Get the buyer who owns the inquiry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all consultation messages for this inquiry.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ConsultationMessage::class)->orderBy('created_at');
    }

    /**
     * Get the human-readable status label.
     */
    public function statusLabel(): string
    {
        return static::statusLabels()[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Determine the status badge color class.
     */
    public function statusColor(): string
    {
        return match ($this->status) {
            'inquiry_received' => 'text-yellow-400 border-yellow-400/30 bg-yellow-400/10',
            'consultation_active' => 'text-blue-400 border-blue-400/30 bg-blue-400/10',
            'spk_issued' => 'text-purple-400 border-purple-400/30 bg-purple-400/10',
            'kyc_pending' => 'text-orange-400 border-orange-400/30 bg-orange-400/10',
            'kyc_approved' => 'text-teal-400 border-teal-400/30 bg-teal-400/10',
            'contract_signed' => 'text-cyan-400 border-cyan-400/30 bg-cyan-400/10',
            'payment_verified' => 'text-green-400 border-green-400/30 bg-green-400/10',
            'scheduled_delivery' => 'text-indigo-400 border-indigo-400/30 bg-indigo-400/10',
            'delivered_completed' => 'text-red-400 border-red-400/30 bg-red-400/10',
            default => 'text-neutral-400 border-neutral-400/30 bg-neutral-400/10',
        };
    }
}
