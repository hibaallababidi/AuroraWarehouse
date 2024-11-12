<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($locaton_id)
 */
class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id',
        'location_name'
    ];
}
