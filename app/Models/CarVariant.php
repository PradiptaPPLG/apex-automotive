<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarVariant extends Model
{
    protected $fillable = [
        'car_id',
        'type',
        'name',
        'hex',
        'stock',
        'image_url',
    ];

    protected $casts = [
        'stock' => 'integer',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
