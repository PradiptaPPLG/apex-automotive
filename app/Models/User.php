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
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
