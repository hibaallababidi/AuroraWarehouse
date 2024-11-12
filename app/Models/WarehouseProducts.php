<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class WarehouseProducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'total_quantity',
        'total_weight',
        'min_quantity',
        'subcategory_id',
        'warehouse_id',
        'company_id'
    ];


}
