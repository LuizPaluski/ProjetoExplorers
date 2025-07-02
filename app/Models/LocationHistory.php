<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'explorer_id',
        'latitude',
        'longitude',
    ];


}
