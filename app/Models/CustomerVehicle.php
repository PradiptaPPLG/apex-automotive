<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerVehicle extends Model
{
    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'year',
        'color',
        'license_plate',
        'vin',
        'mileage_km',
        'image_url',
        'notes',
    ];

    protected $casts = [
        'year' => 'integer',
        'mileage_km' => 'integer',
    ];

    /**
     * Get the owner of this vehicle.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all service bookings for this vehicle.
     */
    public function serviceBookings(): HasMany
    {
        return $this->hasMany(ServiceBooking::class, 'vehicle_id');
    }

    /**
     * Get a friendly display name for this vehicle.
     */
    public function displayName(): string
    {
        return trim("{$this->year} {$this->brand} {$this->model}");
    }
}
