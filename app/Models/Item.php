<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'latitude',
        'longitude',
        'explorer_id',
    ];

    public function explorer(): BelongsTo
    {
        return $this->belongsTo(Explorer::class);
    }
}
