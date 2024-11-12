<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class ProductBatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_quantity',
        'batch_weight',
        'recieve_item_id',
        'department_id'
    ];
}
