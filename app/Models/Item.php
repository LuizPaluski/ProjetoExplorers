<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable; // Mudar para Authenticatable
use Laravel\Sanctum\HasApiTokens;

class Explorer extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'latitude',
        'longitude',
    ];

    protected $hidden = [
        'password',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function locationHistories(): HasMany
    {
        return $this->hasMany(LocationHistory::class);
    }
}
