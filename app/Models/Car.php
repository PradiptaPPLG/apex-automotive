<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'category',
        'price',
        'year',
        'transmission',
        'fuel_type',
        'image_url',
        'description',
        'status',
        'specs',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'specs' => 'array',
    ];
}
