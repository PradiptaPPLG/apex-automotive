<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceProgress extends Model
{
    protected $fillable = [
        'booking_id',
        'phase_label',
        'note',
        'photo_url',
    ];

    /**
     * Get the service booking this progress entry belongs to.
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(ServiceBooking::class, 'booking_id');
    }
}
