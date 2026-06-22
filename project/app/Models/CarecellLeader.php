<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarecellLeader extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'email',
        'leader_role',
        'is_active',
    ];

    protected $casts = [
        'leader_role' => 'integer',
        'is_active'   => 'boolean',
    ];

    public const ROLES = [
        1 => 'Sectional Leader',
        2 => 'Area Leader',
        3 => 'Carecell Leader',
    ];

    public function getRoleNameAttribute(): string
    {
        return self::ROLES[$this->leader_role] ?? 'Unknown';
    }
}
