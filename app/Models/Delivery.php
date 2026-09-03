<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'driver_id',
        'status',
        'delivery_address',
        'special_requests',
        'scheduled_at',
        'notes',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function trackings(): HasMany
    {
        return $this->hasMany(DeliveryTracking::class)->orderBy('created_at', 'asc');
    }

    public function latestTracking()
    {
        return $this->hasOne(DeliveryTracking::class)->latestOfMany();
    }
}
