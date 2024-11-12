<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 * @method static firstWhere(string $string, $code)
 */
class ManagerVerification extends Model
{
    use HasFactory;
    protected $fillable = [
        'manager_id',
        'verification_code'
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
