<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    const STATUS_DUE    = 1;
    const STATUS_PAID   = 2;

    protected $fillable = [ 'name' ];

    public static function getStatuses()
    {
        return collect([
            self::STATUS_DUE    => Str::title('due'),
            self::STATUS_PAID   => Str::title('paid'),
        ]);
    }
}
