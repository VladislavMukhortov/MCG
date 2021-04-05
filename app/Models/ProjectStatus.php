<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProjectStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    const STATUS_NEW            = 1;
    const STATUS_PENDING        = 2;
    const STATUS_SUBS_ASSIGNED  = 3;
    const STATUS_DOCS_SIGNED    = 4;
    const STATUS_IN_PROGRESS    = 5;
    const STATUS_COMPLETE       = 6;


    protected $fillable = [ 'name' ];

    public static function getStatuses()
    {
        return collect([
            self::STATUS_NEW           => Str::title('new'),
            self::STATUS_PENDING       => Str::title('pending'),
            self::STATUS_SUBS_ASSIGNED => Str::title('subs assigned'),
            self::STATUS_DOCS_SIGNED   => Str::title('docs assigned'),
            self::STATUS_IN_PROGRESS   => Str::title('in progress'),
            self::STATUS_COMPLETE      => Str::title('complete'),
        ]);
    }
}
