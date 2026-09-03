<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

#[Fillable(['email', 'token', 'expires_at', 'used'])]
class EmailOtpToken extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'used' => 'boolean',
        ];
    }

    /**
     * Determine whether this token is still valid (not expired and not used).
     */
    public function isValid(): bool
    {
        return ! $this->used && $this->expires_at->isFuture();
    }
}
