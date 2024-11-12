<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class ExportItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'quantity',
        'weight',
        'batch_id'
    ];
}

