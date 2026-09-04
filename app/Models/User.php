<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name', 'email', 'password', 'role',
    'phone', 'nik', 'npwp',
    'address', 'city', 'province',
    'postal_code', 'profile_completed',
    'ownership_type', 'ktp_file', 'kk_file', 'npwp_file',
    'nib_file', 'akta_file', 'kyc_status', 'kyc_notes',
    'avatar', 'id_card_theme',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Payload QR Login rahasia berbasis HMAC
     */
    public function getQrLoginPayloadAttribute(): string
    {
        $secret = config('app.key');
        $hash = hash_hmac('sha256', $this->nik ?? $this->email, $secret);

        return 'qrlogin|' . $this->id . '|' . $hash;
    }

    /**
     * SVG QR Code untuk ID Card
     */
    public function getQrCodeSvgAttribute(): string
    {
        return \App\Helpers\QrCodeSvg::generate($this->qr_login_payload, 130);
    }

    /**
     * Style Tema VIP Access Card
     */
    public function getCardThemeStyleAttribute(): string
    {
        $themes = [
            1 => 'background: linear-gradient(135deg, #09090b 0%, #1c1917 50%, #292524 100%); border-bottom: 2px solid #dc2626;',
            2 => 'background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%); border-bottom: 2px solid #6366f1;',
            3 => 'background: linear-gradient(135deg, #064e3b 0%, #047857 50%, #059669 100%); border-bottom: 2px solid #10b981;',
            4 => 'background: linear-gradient(135deg, #78350f 0%, #b45309 50%, #d97706 100%); border-bottom: 2px solid #f59e0b;',
            5 => 'background: linear-gradient(135deg, #881337 0%, #be123c 50%, #e11d48 100%); border-bottom: 2px solid #f43f5e;',
        ];

        return $themes[$this->id_card_theme ?? 1] ?? $themes[1];
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'profile_completed' => 'boolean',
        ];
    }

    /**
     * Determine whether the user has completed their profile.
     */
    public function hasCompletedProfile(): bool
    {
        return (bool) $this->profile_completed;
    }

    /**
     * Determine whether the user is a Sales RM.
     */
    public function isRm(): bool
    {
        return $this->role === 'rm';
    }

    /**
     * Determine whether the user is a Delivery Driver.
     */
    public function isDelivery(): bool
    {
        return $this->role === 'delivery';
    }

    /**
     * Get all inquiries belonging to this user.
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    /**
     * Get all deliveries assigned to this driver.
     */
    public function deliveryShipments(): HasMany
    {
        return $this->hasMany(Delivery::class, 'driver_id');
    }
}
