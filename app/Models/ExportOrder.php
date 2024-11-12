<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class ExportOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'warehouse_id',
        'by_manager',
        'manager_id',
        'keeper_id',
        'client_id',
        'order_date'
    ];
}

