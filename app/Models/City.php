<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($city_id)
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name'
    ];
}
