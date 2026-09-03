<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['inquiry_id', 'sender_type', 'sender_name', 'message', 'is_read'])]
class ConsultationMessage extends Model
{
    /**
     * Get the inquiry that this message belongs to.
     */
    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }
}
