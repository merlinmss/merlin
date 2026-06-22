<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarecellArea extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'area_name',
        'area_description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
