<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class RecieveItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'quantity',
        'weight',
        'expiration_date',
        'warehouse_product_id'
    ];
}
