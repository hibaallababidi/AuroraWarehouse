<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class RecieveOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'by_manager',
        'client_id',
        'manager_id',
        'keeper_id',
        'order_date'
    ];
}

