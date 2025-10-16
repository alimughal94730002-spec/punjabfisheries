<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShrimpSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'district',
        'tehsil',
        'area_acres',
        'status',
        'lat',
        'lng',
        'images',
        'marker_icon',
        'description',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'area_acres' => 'decimal:2',
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
    ];
}
