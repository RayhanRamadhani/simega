<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration_month',
        'price',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}