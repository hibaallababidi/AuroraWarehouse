<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $warehouse_id)
 * @method static create(array $array)
 */
class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
        'department_info',
        'warehouse_id'
    ];
}
