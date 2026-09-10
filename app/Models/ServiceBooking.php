<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceBooking extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'service_type',
        'title',
        'description',
        'preferred_date',
        'preferred_time',
        'delivery_method',
        'status',
        'assigned_mechanic_name',
        'estimated_cost',
        'actual_cost',
        'reference_images',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'estimated_cost' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'reference_images' => 'array',
    ];

    /**
     * All service status codes mapped to human-readable labels.
     *
     * @return array<string, string>
     */
    public static function statusLabels(): array
    {
        return [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Booking Dikonfirmasi',
            'in_progress' => 'Sedang Dikerjakan',
            'qc_check' => 'Quality Control',
            'ready' => 'Siap Diserahkan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
    }

    /**
     * All service type codes mapped to human-readable labels.
     *
     * @return array<string, string>
     */
    public static function serviceTypeLabels(): array
    {
        return [
            'periodic_service' => 'Periodic Service (Ganti Oli, Tune-up, dll)',
            'performance_tuning' => 'Performance Tuning (ECU Remap, Stage 1-3)',
            'bodywork' => 'Bodywork & Aero Kit',
            'exhaust' => 'Titanium Exhaust System',
            'suspension' => 'Suspension / Airsuspension',
            'custom' => 'Custom Modification',
        ];
    }

    /**
     * Get the human-readable status label.
     */
    public function statusLabel(): string
    {
        return static::statusLabels()[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get the human-readable service type label.
     */
    public function serviceTypeLabel(): string
    {
        return static::serviceTypeLabels()[$this->service_type] ?? ucfirst($this->service_type);
    }

    /**
     * Determine the status badge color class.
     */
    public function statusColor(): string
    {
        return match ($this->status) {
            'pending' => 'text-yellow-400 border-yellow-400/30 bg-yellow-400/10',
            'confirmed' => 'text-blue-400 border-blue-400/30 bg-blue-400/10',
            'in_progress' => 'text-orange-400 border-orange-400/30 bg-orange-400/10',
            'qc_check' => 'text-purple-400 border-purple-400/30 bg-purple-400/10',
            'ready' => 'text-teal-400 border-teal-400/30 bg-teal-400/10',
            'completed' => 'text-green-400 border-green-400/30 bg-green-400/10',
            'cancelled' => 'text-neutral-400 border-neutral-400/30 bg-neutral-400/10',
            default => 'text-neutral-400 border-neutral-400/30 bg-neutral-400/10',
        };
    }

    /**
     * Get the service type icon (Font Awesome class).
     */
    public function serviceTypeIcon(): string
    {
        return match ($this->service_type) {
            'periodic_service' => 'fa-oil-can',
            'performance_tuning' => 'fa-gauge-high',
            'bodywork' => 'fa-car-side',
            'exhaust' => 'fa-fire',
            'suspension' => 'fa-sliders',
            'custom' => 'fa-screwdriver-wrench',
            default => 'fa-wrench',
        };
    }

    /**
     * Get the owner/customer of this booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the vehicle being serviced.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(CustomerVehicle::class, 'vehicle_id');
    }

    /**
     * Get all chat messages for this booking.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ServiceMessage::class, 'booking_id')->orderBy('created_at');
    }

    /**
     * Get all progress update entries for this booking.
     */
    public function progressUpdates(): HasMany
    {
        return $this->hasMany(ServiceProgress::class, 'booking_id')->orderBy('created_at');
    }
}
