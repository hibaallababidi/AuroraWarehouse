<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Keeper;

/**
 * @method static find($id)
 * @method static where(string $string, $id)
 * @method static create(array $array)
 */
class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'warehouse_name',
        'location_id',
        'manager_id'
    ];


}
