<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TvCode extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'active',
        'expires_at'
    ];

    public static function generateUniqueCode()
    {
        do {
            $randomDigits = random_int(100000, 999999);

            $exists = self::where('code', $randomDigits)->exists();
        } while ($exists);

        return $randomDigits;
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
