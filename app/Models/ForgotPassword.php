<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static firstWhere(string $string, $code)
 * @method static where(string $string, $id)
 */
class ForgotPassword extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_manager',
        'verification_code',
        'manager_id',
        'keeper_id'
    ];

    public function isExpire()
    {
        if ($this->created_at > now()->addHour()) {
            $this->delete();
            return true;
        }
        return false;
    }
}
