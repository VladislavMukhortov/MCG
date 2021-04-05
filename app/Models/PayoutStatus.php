<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PayoutStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    const STATUS_PENDING    = 1;
    const STATUS_PAID       = 2;

    protected $fillable = [ 'name' ];

    public static function getStatuses()
    {
        return collect([
            self::STATUS_PENDING    => Str::title('pending'),
            self::STATUS_PAID       => Str::title('paid'),
        ]);
    }
}
