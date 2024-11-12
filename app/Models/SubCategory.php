<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $sub_category_id)
 * @method static find($sub_category_id)
 */
class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_category',
        'photo_path',
        'category_id'
    ];
}
